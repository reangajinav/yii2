<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kecamatan".
 *
 * @property int $id
 * @property int $provinsi_id
 * @property int $kabupaten_id
 * @property string $nama
 * @property int $jumlah_penduduk
 *
 * @property Provinsi $provinsi
 * @property Kabupaten $kabupaten
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kecamatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provinsi_id', 'kabupaten_id', 'nama', 'jumlah_penduduk'], 'required'],
            [['provinsi_id', 'kabupaten_id', 'jumlah_penduduk'], 'integer'],
            [['nama'], 'string', 'max' => 500],
            [['provinsi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['provinsi_id' => 'id']],
            [['kabupaten_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['kabupaten_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provinsi_id' => 'Provinsi ID',
            'kabupaten_id' => 'Kabupaten ID',
            'nama' => 'Nama',
            'jumlah_penduduk' => 'Jumlah Penduduk',
        ];
    }

    /**
     * Gets query for [[Provinsi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['id' => 'provinsi_id']);
    }

    /**
     * Gets query for [[Kabupaten]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['id' => 'kabupaten_id']);
    }

    public function getDataList($filter){
        $query =  Kecamatan::find()->orderBy('nama');
        if($filter)
            $query->where($filter);
        return $query->all();
    }

    public function getDepDropOptions($filter)
    {
        $data_list = self::getDataList($filter);

        foreach ($data_list as $i => $value) {
                $out[$i]['id'] = $value['id'];
                $out[$i]['name'] = $value['nama'];    
            }
        return($out);
    }
}
