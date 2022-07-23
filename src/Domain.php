<?php

namespace nguyenanhung\Tool\DrVirus;

/**
 * Class Domain
 *
 * @package nguyenanhung\Tool\DrVirus
 */
class Domain extends Base
{
    /**
     * Function getReport
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:46
     *
     * @param $domain
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getReport($domain)
    {
        $data = $this->makeGetRequest('domain/report', array(
            'domain' => $domain,
            'apikey' => $this->_apiKey,
        ));

        return $data;
    }
}
