<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provinsi".
 *
 * @property int $id
 * @property string $nama
 *
 * @property Kabupaten[] $kabupatens
 * @property Kecamatan[] $kecamatans
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provinsi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[Kabupatens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKabupatens()
    {
        return $this->hasMany(Kabupaten::className(), ['provinsi_id' => 'id']);
    }

    /**
     * Gets query for [[Kecamatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatans()
    {
        return $this->hasMany(Kecamatan::className(), ['provinsi_id' => 'id']);
    }

    public function getJumlahPendudukCount()
    {
        $hasil = $this->hasMany(Kecamatan::className(), ['provinsi_id' => 'id'])->sum('jumlah_penduduk');
        if($hasil==null)
        {
            $hasil = 0;
        }

        return $hasil;
    }
}
