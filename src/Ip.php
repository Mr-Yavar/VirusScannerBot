<?php

namespace nguyenanhung\Tool\DrVirus;

/**
 * Class Ip
 *
 * @package   nguyenanhung\Tool\DrVirus
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Ip extends Base
{
    /**
     * Function getReport
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:45
     *
     * @param $ip
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getReport($ip)
    {
        $data = $this->makeGetRequest('ip-address/report', array(
            'ip'     => $ip,
            'apikey' => $this->_apiKey,
        ));

        return $data;
    }

}
