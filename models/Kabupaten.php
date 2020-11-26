<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 *
 * @property int $id
 * @property int $provinsi_id
 * @property string $nama
 *
 * @property Provinsi $provinsi
 * @property Kecamatan[] $kecamatans
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kabupaten';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provinsi_id', 'nama'], 'required'],
            [['provinsi_id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['provinsi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinsi::className(), 'targetAttribute' => ['provinsi_id' => 'id']],
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
            'nama' => 'Nama',
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
     * Gets query for [[Kecamatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatans()
    {
        return $this->hasMany(Kecamatan::className(), ['kabupaten_id' => 'id']);
    }

    public function getJumlahPendudukCount()
    {
        $hasil = $this->hasMany(Kecamatan::className(), ['kabupaten_id' => 'id'])->sum('jumlah_penduduk');
        if($hasil==null)
        {
            $hasil = 0;
        }

        return $hasil;
    }

    public function getDataList($filter){
        $query =  Kabupaten::find()->orderBy('nama');
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
