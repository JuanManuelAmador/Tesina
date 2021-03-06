<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/photos/library/v1/photos_library.proto

namespace Google\Photos\Library\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request to update an album in Google Photos.
 *
 * Generated from protobuf message <code>google.photos.library.v1.UpdateAlbumRequest</code>
 */
class UpdateAlbumRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The [Album][google.photos.types.Album] to update.
     * The album’s `id` field is used to identify the album to be updated.
     * The album’s `title` field is used to set the new album title.
     * The album’s `cover_photo_media_item_id` field is used to set the new album
     * cover photo.
     *
     * Generated from protobuf field <code>.google.photos.types.Album album = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    protected $album = null;
    /**
     * Required. Indicate what fields in the provided album to update.
     * The only valid values are `title` and `cover_photo_media_item_id`.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    protected $update_mask = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Photos\Types\Album $album
     *           Required. The [Album][google.photos.types.Album] to update.
     *           The album’s `id` field is used to identify the album to be updated.
     *           The album’s `title` field is used to set the new album title.
     *           The album’s `cover_photo_media_item_id` field is used to set the new album
     *           cover photo.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           Required. Indicate what fields in the provided album to update.
     *           The only valid values are `title` and `cover_photo_media_item_id`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Photos\Library\V1\PhotosLibrary::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The [Album][google.photos.types.Album] to update.
     * The album’s `id` field is used to identify the album to be updated.
     * The album’s `title` field is used to set the new album title.
     * The album’s `cover_photo_media_item_id` field is used to set the new album
     * cover photo.
     *
     * Generated from protobuf field <code>.google.photos.types.Album album = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Photos\Types\Album|null
     */
    public function getAlbum()
    {
        return isset($this->album) ? $this->album : null;
    }

    public function hasAlbum()
    {
        return isset($this->album);
    }

    public function clearAlbum()
    {
        unset($this->album);
    }

    /**
     * Required. The [Album][google.photos.types.Album] to update.
     * The album’s `id` field is used to identify the album to be updated.
     * The album’s `title` field is used to set the new album title.
     * The album’s `cover_photo_media_item_id` field is used to set the new album
     * cover photo.
     *
     * Generated from protobuf field <code>.google.photos.types.Album album = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Photos\Types\Album $var
     * @return $this
     */
    public function setAlbum($var)
    {
        GPBUtil::checkMessage($var, \Google\Photos\Types\Album::class);
        $this->album = $var;

        return $this;
    }

    /**
     * Required. Indicate what fields in the provided album to update.
     * The only valid values are `title` and `cover_photo_media_item_id`.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Protobuf\FieldMask|null
     */
    public function getUpdateMask()
    {
        return isset($this->update_mask) ? $this->update_mask : null;
    }

    public function hasUpdateMask()
    {
        return isset($this->update_mask);
    }

    public function clearUpdateMask()
    {
        unset($this->update_mask);
    }

    /**
     * Required. Indicate what fields in the provided album to update.
     * The only valid values are `title` and `cover_photo_media_item_id`.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;

        return $this;
    }

}

