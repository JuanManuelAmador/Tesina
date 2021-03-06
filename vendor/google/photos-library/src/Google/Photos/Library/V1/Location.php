<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/photos/library/v1/photos_library.proto

namespace Google\Photos\Library\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents a physical location.
 *
 * Generated from protobuf message <code>google.photos.library.v1.Location</code>
 */
class Location extends \Google\Protobuf\Internal\Message
{
    /**
     * Name of the location to be displayed.
     *
     * Generated from protobuf field <code>string location_name = 1;</code>
     */
    protected $location_name = '';
    /**
     * Position of the location on the map.
     *
     * Generated from protobuf field <code>.google.type.LatLng latlng = 2;</code>
     */
    protected $latlng = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $location_name
     *           Name of the location to be displayed.
     *     @type \Google\Type\LatLng $latlng
     *           Position of the location on the map.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Photos\Library\V1\PhotosLibrary::initOnce();
        parent::__construct($data);
    }

    /**
     * Name of the location to be displayed.
     *
     * Generated from protobuf field <code>string location_name = 1;</code>
     * @return string
     */
    public function getLocationName()
    {
        return $this->location_name;
    }

    /**
     * Name of the location to be displayed.
     *
     * Generated from protobuf field <code>string location_name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setLocationName($var)
    {
        GPBUtil::checkString($var, True);
        $this->location_name = $var;

        return $this;
    }

    /**
     * Position of the location on the map.
     *
     * Generated from protobuf field <code>.google.type.LatLng latlng = 2;</code>
     * @return \Google\Type\LatLng|null
     */
    public function getLatlng()
    {
        return isset($this->latlng) ? $this->latlng : null;
    }

    public function hasLatlng()
    {
        return isset($this->latlng);
    }

    public function clearLatlng()
    {
        unset($this->latlng);
    }

    /**
     * Position of the location on the map.
     *
     * Generated from protobuf field <code>.google.type.LatLng latlng = 2;</code>
     * @param \Google\Type\LatLng $var
     * @return $this
     */
    public function setLatlng($var)
    {
        GPBUtil::checkMessage($var, \Google\Type\LatLng::class);
        $this->latlng = $var;

        return $this;
    }

}

