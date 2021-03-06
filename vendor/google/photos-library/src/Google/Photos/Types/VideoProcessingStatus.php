<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/photos/types/media_item.proto

namespace Google\Photos\Types;

use UnexpectedValueException;

/**
 * Processing status of a video being uploaded to Google Photos.
 *
 * Protobuf type <code>google.photos.types.VideoProcessingStatus</code>
 */
class VideoProcessingStatus
{
    /**
     * Video processing status is unknown.
     *
     * Generated from protobuf enum <code>UNSPECIFIED = 0;</code>
     */
    const UNSPECIFIED = 0;
    /**
     * Video is being processed. The user sees an icon for this
     * video in the Google Photos app; however, it isn't playable yet.
     *
     * Generated from protobuf enum <code>PROCESSING = 1;</code>
     */
    const PROCESSING = 1;
    /**
     * Video processing is complete and it is now ready for viewing.
     * Important: attempting to download a video not in the READY state may fail.
     *
     * Generated from protobuf enum <code>READY = 2;</code>
     */
    const READY = 2;
    /**
     * Something has gone wrong and the video has failed to process.
     *
     * Generated from protobuf enum <code>FAILED = 3;</code>
     */
    const FAILED = 3;

    private static $valueToName = [
        self::UNSPECIFIED => 'UNSPECIFIED',
        self::PROCESSING => 'PROCESSING',
        self::READY => 'READY',
        self::FAILED => 'FAILED',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

