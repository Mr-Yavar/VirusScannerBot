<?php

namespace nguyenanhung\Tool\DrVirus;

/**
 * Class Url
 *
 * @package   nguyenanhung\Tool\DrVirus
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Url extends Base
{
    /**
     * Function scan
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:44
     *
     * @param $url
     *
     * @return mixed
     */
    public function scan($url)
    {
        $data = $this->makePostRequest('url/scan', array(
            'url'    => $url,
            'apikey' => $this->_apiKey,
        ));

        return $data;
    }

    /**
     * Function getReport
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-14 20:45
     *
     * @param $resource
     *
     * @return mixed
     */
    public function getReport($resource)
    {
        $data = $this->makePostRequest('url/report', array(
            'resource' => $resource,
            'apikey'   => $this->_apiKey,
        ));

        return $data;
    }
}
