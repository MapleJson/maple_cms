<?php
declare (strict_types = 1);

namespace app\middleware;

class Attack
{
    // get拦截规则
    const GET_FILTER = "<[^>]*?=[^>]*?&#[^>]*?>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b[^>]*?>|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    // post拦截规则
    const POST_FILTER = "<[^>]*?=[^>]*?&#[^>]*?>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b[^>]*?>|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    // cookie拦截规则
    const COOKIE_FILTER = "\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    // request拦截规则
    const REQUEST_FILTER = "<[^>]*?=[^>]*?&#[^>]*?>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b[^>]*?>|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     *
     * @return \think\Response
     */
    public function handle($request, \Closure $next)
    {
        foreach ($request->get() as $key => $value) {
            if ($this->attack($key, $value, self::GET_FILTER)) {
                return response('您提交的内容有敏感字符串,请检查后重新提交', 500);
            }
        }
        foreach ($request->post() as $key => $value) {
            if ($this->attack($key, $value, self::POST_FILTER)) {
                return response('您提交的内容有敏感字符串,请检查后重新提交', 500);
            }
        }
        foreach ($request->put() as $key => $value) {
            if ($this->attack($key, $value, self::POST_FILTER)) {
                return response('您提交的内容有敏感字符串,请检查后重新提交', 500);
            }
        }
        foreach ($request->delete() as $key => $value) {
            if ($this->attack($key, $value, self::POST_FILTER)) {
                return response('您提交的内容有敏感字符串,请检查后重新提交', 500);
            }
        }
        foreach ($request->cookie() as $key => $value) {
            if ($this->attack($key, $value, self::COOKIE_FILTER)) {
                return response('您提交的内容有敏感字符串,请检查后重新提交', 500);
            }
        }
        foreach ($request->request() as $key => $value) {
            if ($this->attack($key, $value, self::REQUEST_FILTER)) {
                return response('您提交的内容有敏感字符串,请检查后重新提交', 500);
            }
        }

        return $next($request);
    }

    /**
     * 检查逻辑
     *
     * @param  string       $key
     * @param  string|array $value
     * @param string        $filter
     *
     * @return bool
     */
    private function attack(string $key, $value, string $filter)
    {
        $requestFilters = [
            'UPDATE', 'INSERT', 'UNION', 'INTO', 'SET', 'SELECT',
            'DELETE', 'VALUES', 'FROM', 'CREATE', 'ALTER', 'DROP',
            'TRUNCATE', 'TABLE', 'DATABASE', 'SLEEP',
        ];

        $tableFilters = [
            'C_BET', 'K_BET', 'K_USER_CASH_RECORD', 'K_USER', 'BET_RECORD',
            'PAY_SET', 'K_BANK', 'PAY_OUT_SET', 'SYS_ADMIN', '`', 'SCRIPT',
        ];

        $fieldFilters = ['BBFC_BET', 'FC_BET', 'EGTC_BET', 'PK_BET'];

        $filterValue = strtoupper($this->arrayToString($this->strCheck($value)));

        if (preg_match("/" . $filter . "/is", $filterValue) == 1) {
            $this->writeLog($key, $filterValue);
            return true;
        }
        if (preg_match("/" . $filter . "/is", $key) == 1) {
            $this->writeLog($key, $filterValue);
            return true;
        }
        foreach ($tableFilters as $tableFilter) {
            foreach ($fieldFilters as $fieldFilter) {
                $filterValue = str_replace($fieldFilter, '', $filterValue);
            }
            if (strpos($filterValue, $tableFilter) !== false) {
                $this->writeLog($key, $filterValue);
                return true;
            }
        }
        foreach ($requestFilters as $val) {
            if (preg_match("/\b" . $val . "\b/is", $filterValue) == 1) {
                if ($val == 'TABLE' && preg_match_all("/(<\/|<)\b" . $val . "\b/is", $filterValue) == preg_match_all("/\b" . $val . "\b/is", $filterValue)) {
                    continue;
                }
                $this->writeLog($key, $filterValue);
                return true;
            }
        }

        $crucial = [
            "[k|K](%[0-9a-zA-Z]{1,8})*[_](%[0-9a-zA-Z]{1,8})*[u|U](%[0-9a-zA-Z]{1,8})*[s|S](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[r|R]",
            "[d|D](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[l|L](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[t|T](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[f|F](%[0-9a-zA-Z]{1,8})*[r|R](%[0-9a-zA-Z]{1,8})*[o|O](%[0-9a-zA-Z]{1,8})*[m|M]",
            "[r|R](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[p|P](%[0-9a-zA-Z]{1,8})*[l|L](%[0-9a-zA-Z]{1,8})*[a|A](%[0-9a-zA-Z]{1,8})*[c|C](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[u|U](%[0-9a-zA-Z]{1,8})*[p|P](%[0-9a-zA-Z]{1,8})*[d|D](%[0-9a-zA-Z]{1,8})*[a|A](%[0-9a-zA-Z]{1,8})*[t|T](%[0-9a-zA-Z]{1,8})*[e|E]",
            "[u|U](%[0-9a-zA-Z]{1,8})*[p|P](%[0-9a-zA-Z]{1,8})*[d|D](%[0-9a-zA-Z]{1,8})*[a|A](%[0-9a-zA-Z]{1,8})*[t|T](%[0-9a-zA-Z]{1,8})*[e|E]",
            "[s|S](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[l|L](%[0-9a-zA-Z]{1,8})*[e|E](%[0-9a-zA-Z]{1,8})*[c|C](%[0-9a-zA-Z]{1,8})*[t|T]"
        ];

        $filterValue = str_replace("+", '', urlencode($filterValue));
        foreach ($crucial as $cru) {
            if (preg_match("/" . $cru . "/is", $filterValue) == 1) {
                $this->writeLog($key, $filterValue);
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $key
     * @param        $value
     */
    private function writeLog(string $key, $value)
    {
        $log = json_encode([
                'ip'          => request()->ip(),
                'time'        => strftime("%Y-%m-%d %H:%M:%S"),
                'page'        => $_SERVER["PHP_SELF"],
                'method'      => request()->method(),
                'rkey'        => $key,
                'rdata'       => $value,
                'user_agent'  => request()->header('user_agent'),
                'request_url' => request()->url(true)
            ]
        );

        $file      = 'attackLog';
        $mtime     = explode(' ', microtime());
        $yearmonth = date('Ym', (int)$mtime[1]);
        $logDir    = runtime_path('attackLog');
        if (!is_dir($logDir)) mkdir($logDir, 0777);
        $logfile = $logDir . $yearmonth . '_' . $file . '.php';
        if (@filesize($logfile) > 2048000) {
            $dir    = opendir($logDir);
            $length = strlen($file);
            $maxId  = $id = 0;
            while ($entry = readdir($dir)) {
                if (strpos($entry, $yearmonth . '_' . $file) !== false) {
                    $id = intval(substr($entry, $length + 8, -4));
                    $id > $maxId && $maxId = $id;
                }
            }
            closedir($dir);
            $logFileBak = $logDir . $yearmonth . '_' . $file . '_' . ($maxId + 1) . '.php';
            @rename($logfile, $logFileBak);
        }
        $log = trim($log) . "\n";
        if ($fp = @fopen($logfile, 'a')) {
            @flock($fp, 2);
            fwrite($fp, "<?PHP exit;?>\t" . str_replace(['<?', '?>', "\r", "\n"], '', $log) . "\n");
            fclose($fp);
        }
    }

    /**
     * 参数拆分
     *
     * @param $param
     *
     * @return string
     */
    private function arrayToString($param)
    {
        static $str;
        if (!is_array($param)) {
            return $param;
        }
        foreach ($param as $key => $val) {
            if (is_array($val)) {
                $this->arrayToString($val);
            } else {
                $str[] = $val;
            }
        }
        return implode($str);
    }

    private function strCheck($str)
    {
        $str = preg_replace('/[\x00-\x08]|[\x0b-\x0c]|[\x0e-\x1e]/', '', $str);
        return $str;
    }
}
