<?php 
namespace App\Helpers;
use Illuminate\Support\Str;
use App\Models\SettingApplication;
use Illuminate\Support\Facades\Auth;


class Helper
{
    protected static $response = [
        'code' => 200,
        'success' => true,
        'message' => null,
        'results' => null
    ];

    public static function success($data = null, $message = null, $code = 200)
    {
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['results'] = $data;
        return response()->json(self::$response);
    }

    public static function error($data = null, $message = null, $code = 400)
    {
        self::$response['success'] = false;
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['results'] = $data;
        return response()->json(self::$response);
    }

    public static function priceToNumber($value)
    {
        if (!$value) {
            return 0;
        }
        $value = preg_replace('/[^0-9,]/', '', $value);
        $value = str_replace(',', '.', $value);
        $value = floatval($value);
        return $value;
    }

    public static function numberToPrice($value)
    {
        if (!$value) {
            $value = 0;
        }
        $result = str_replace('.', '', $value);
        return number_format($result, 0, ".", ".");
    }    

    public static function indonesiaDateFormat($date)
    {
        $month = [
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        
        $exploded = explode('-', $date);
         
        return $exploded[2] . ' ' . $month[ (int)$exploded[1] ] . ' ' . $exploded[0];
    }

    public static function point_to_comma($value)
	{
		$result = str_replace('.', ',', $value);
		return $result;
	}

	public static function comma_to_point($value)
	{
		$result = str_replace(',', '.', $value);
		return $result;
	}

    public static function remove_file($file)
	{
        if (file_exists($file)) {
            unlink($file);
        }
	}

    public static function generate_filename($file,$title = 'title-example',$prefix = 'file-')
	{
        $filename = $prefix . time() . '-' . Str::limit(Str::slug($title), 50, '') . '-' . strtotime('now') . '.' . $file->getClientOriginalExtension();
        return $filename;
    }
  
}