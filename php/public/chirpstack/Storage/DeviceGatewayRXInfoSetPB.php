<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: device_session.proto

namespace Storage;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>storage.DeviceGatewayRXInfoSetPB</code>
 */
class DeviceGatewayRXInfoSetPB extends \Google\Protobuf\Internal\Message
{
    /**
     * Device EUI.
     *
     * Generated from protobuf field <code>bytes dev_eui = 1;</code>
     */
    private $dev_eui = '';
    /**
     * Data-rate.
     *
     * Generated from protobuf field <code>uint32 dr = 2;</code>
     */
    private $dr = 0;
    /**
     * Items contains set items.
     *
     * Generated from protobuf field <code>repeated .storage.DeviceGatewayRXInfoPB items = 3;</code>
     */
    private $items;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $dev_eui
     *           Device EUI.
     *     @type int $dr
     *           Data-rate.
     *     @type \Storage\DeviceGatewayRXInfoPB[]|\Google\Protobuf\Internal\RepeatedField $items
     *           Items contains set items.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\DeviceSession::initOnce();
        parent::__construct($data);
    }

    /**
     * Device EUI.
     *
     * Generated from protobuf field <code>bytes dev_eui = 1;</code>
     * @return string
     */
    public function getDevEui()
    {
        return $this->dev_eui;
    }

    /**
     * Device EUI.
     *
     * Generated from protobuf field <code>bytes dev_eui = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setDevEui($var)
    {
        GPBUtil::checkString($var, False);
        $this->dev_eui = $var;

        return $this;
    }

    /**
     * Data-rate.
     *
     * Generated from protobuf field <code>uint32 dr = 2;</code>
     * @return int
     */
    public function getDr()
    {
        return $this->dr;
    }

    /**
     * Data-rate.
     *
     * Generated from protobuf field <code>uint32 dr = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setDr($var)
    {
        GPBUtil::checkUint32($var);
        $this->dr = $var;

        return $this;
    }

    /**
     * Items contains set items.
     *
     * Generated from protobuf field <code>repeated .storage.DeviceGatewayRXInfoPB items = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Items contains set items.
     *
     * Generated from protobuf field <code>repeated .storage.DeviceGatewayRXInfoPB items = 3;</code>
     * @param \Storage\DeviceGatewayRXInfoPB[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setItems($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Storage\DeviceGatewayRXInfoPB::class);
        $this->items = $arr;

        return $this;
    }

}

