<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/common.proto

namespace Common;

/**
 * Protobuf type <code>common.LocationSource</code>
 */
class LocationSource
{
    /**
     * Unknown.
     *
     * Generated from protobuf enum <code>UNKNOWN = 0;</code>
     */
    const UNKNOWN = 0;
    /**
     * GPS.
     *
     * Generated from protobuf enum <code>GPS = 1;</code>
     */
    const GPS = 1;
    /**
     * Manually configured.
     *
     * Generated from protobuf enum <code>CONFIG = 2;</code>
     */
    const CONFIG = 2;
    /**
     * Geo resolver (TDOA).
     *
     * Generated from protobuf enum <code>GEO_RESOLVER_TDOA = 3;</code>
     */
    const GEO_RESOLVER_TDOA = 3;
    /**
     * Geo resolver (RSSI).
     *
     * Generated from protobuf enum <code>GEO_RESOLVER_RSSI = 4;</code>
     */
    const GEO_RESOLVER_RSSI = 4;
    /**
     * Geo resolver (GNSS).
     *
     * Generated from protobuf enum <code>GEO_RESOLVER_GNSS = 5;</code>
     */
    const GEO_RESOLVER_GNSS = 5;
    /**
     * Geo resolver (WIFI).
     *
     * Generated from protobuf enum <code>GEO_RESOLVER_WIFI = 6;</code>
     */
    const GEO_RESOLVER_WIFI = 6;
}

