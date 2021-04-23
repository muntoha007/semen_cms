<?php

/*
| MY Helpers.
|
| @author Andre Siantana <andre.anson@rebelworks.co>
*/
use App\Models\Agent;


if (! function_exists('user_info')) {
    /**
     * Get logged user info.
     *
     * @param  string $column
     * @return mixed
     */
    function user_info($column = null)
    {
        if ($user = Sentinel::check()) {
            // dd($user);
            if (is_null($column)) {
                return $user;
            }

            if ('full_name' == $column) {
                return user_info('first_name').' '.user_info('last_name');
            }

            if ('role' == $column) {
                return user_info()->roles[0];
            }

            return $user->{$column};
        }

        return null;
    }
}

if (! function_exists('sessionFlash')) {
    function sessionFlash($message,$type)
    {
        session()->put('notification',[
            'message' => $message,
            'alert-type' => $type,
        ]);
    }
}

if (! function_exists('link_to_avatar')) {
    /**
     * Generates link to avatar.
     *
     * @param  null|string $path
     * @return string
     */
    function link_to_avatar($path = null)
    {
        if (is_null($path) || ! file_exists(avatar_path($path))) {
            return 'http://lorempixel.com/128/128/';
        }

        return asset('images/avatars').'/'.trim($path, '/');
    }
}

if (! function_exists('avatar_path')) {
    /**
     * Generates avatars path.
     *
     * @param  null|string $path
     * @return string
     */
    function avatar_path($path = null)
    {
        $link = public_path('images/avatars');

        if (is_null($path)) {
            return $link;
        }

        return $link.'/'.trim($path, '/');
    }
}

if (! function_exists('avatar_user_path')) {
    /**
     * Generates avatar user path.
     *
     * @param  null|string $path
     * @return string
     */
    function avatar_user_path($path = null)
    {
        $link = public_path('images/avatars/users');

        if (is_null($path)) {
            return $link;
        }

        return $link.'/'.trim($path, '/');
    }
}

if (! function_exists('datatables')) {
    /**
     * Shortcut for Datatables::of().
     *
     * @param  mixed $builder
     * @return mixed
     */
    function datatables($builder)
    {
        return Datatables::of($builder);
    }
}

if (! function_exists('upload_file')) {
    function upload_file($data, $filepath = 'uploads/', $filetype = 'image', $type = 'public')
    {
        if (!empty($data) && $data->isValid()) {
            $fileExtension = strtolower($data->getClientOriginalExtension());
            $newFilename = Str::random(20) . '.' . $fileExtension;

            if (!File::exists($filepath)) {
                File::makeDirectory($filepath, $mode = 0777, true, true);
            }

            if ($filetype == 'image' ){
                $file = Image::make($data);
                $file->save($filepath . $newFilename);
                // $compressedImage = compress_image($filepath.$newFilename);
                // $imageThumbnail = image_thumbnail($filepath.$newFilename);
            } else {
                $file = $data->move($filepath, $newFilename);
            }
            $result['original'] = $filepath.$newFilename;
            // $result['original'] = $compressedImage;
            // $result['thumbnail'] = $imageThumbnail;

            return  $result;
        }

        return '';
    }
}

if (! function_exists('get_file')) {
    function get_file($path, $preview = 'compressed', $type = 'public')
    {
        // $path_default = 'assets/frontend/images/yamaha_default.jpg';
        // if(! File::exists($path)) {
        //     return URL::to($path_default);
        // }

        if ($type == 'public' && !empty($path) ){
            if ($preview == 'thumbnail'){
                return URL::to(dirname($path).'/thumb/'.basename($path));
            } else {
                return URL::to($path);
            }

        } else {
            //storage path

        }

    }
}

if (! function_exists('delete_file')) {
    function delete_file($path, $type = 'public')
    {
        if ($type == 'public') {
            $dirname = dirname($path);
            $filename = basename($path);

            if(file_exists(public_path().'/'.$path)){
                File::delete($path); // original
            }

            if(file_exists(public_path().'/'.$dirname.'/compressed/'.$filename)){
                File::delete($dirname.'/compressed/'.$filename);
            }

            if(file_exists(public_path().'/'.$dirname.'/thumb/'.$filename)){
                File::delete($dirname.'/thumb/'.$filename);
            }
        } else {
            if (Storage::has($path)) {
                return Storage::delete($path);
            }
        }
    }
}

if (! function_exists('compress_image')) {
    function compress_image($path, $width = 1366, $type = 'public')
    {
        if($type == 'public'){
            $thumb_path = public_path().'/'.dirname($path).'/compressed/';
            list($img_width, $img_height) = getimagesize(public_path().'/'.$path);

            if($img_width < $width){
                $width = $img_width;
            }

            if(!File::exists($thumb_path)) {
                File::makeDirectory($thumb_path, $mode = 0777, true, true);
            }

            $img = Image::make(public_path() .'/'.$path);
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumb_path.basename($path), 20);

            return dirname($path).'/compressed/'.basename($path);
        }else{
            //storage path
        }
    }
}

if (! function_exists('image_thumbnail')) {
    function image_thumbnail($path, $width = 200, $type = 'public')
    {
        if($type == 'public'){
            $thumb_path = public_path().'/'.dirname($path).'/thumb/';
            list($img_width, $img_height) = getimagesize(public_path().'/'.$path);

            if($img_width < $width){
                $width = $img_width;
            }

            if(!File::exists($thumb_path)) {
                File::makeDirectory($thumb_path, $mode = 0777, true, true);
            }

            $img = Image::make(public_path() .'/'.$path);
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save($thumb_path.basename($path), 60);

            return dirname($path).'/thumb/'.basename($path);
        }else{
            //storage path
        }
    }
}

if (! function_exists('myDatetime')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function myDatetime($datetime)
    {
        return date(env('APP_DATE_FORMAT', 'd M Y H:i:s'), strtotime($datetime));
    }
}

if (! function_exists('getDayIndo')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function getDayIndo($date)
    {
        $day = date('D', strtotime($date));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );

        return $dayList[$day];
    }
}

if (! function_exists('getDateIndo')) {
    /**
     * Generate new datetime from configured format datetime.
     *
     * @param  string $datetime
     * @return string
     */
    function getDateIndo($date)
    {
        switch(date("F", strtotime($date)))
        {
            case 'January':     $nmb="Januari";     break;
            case 'February':    $nmb="Februari";    break;
            case 'March':       $nmb="Maret";       break;
            case 'April':       $nmb="April";       break;
            case 'May':         $nmb="Mei";         break;
            case 'June':        $nmb="Juni";        break;
            case 'July':        $nmb="Juli";        break;
            case 'August':      $nmb="Agustus";     break;
            case 'September':   $nmb="September";   break;
            case 'October':     $nmb="Oktober";     break;
            case 'November':    $nmb="November";    break;
            case 'Desember':    $nmb="Desember";    break;
        }

        return date("d",strtotime($date))." "."$nmb"." ".date("Y",strtotime($date));
    }
}

if (! function_exists('time_elapsed_string')) {
    function time_elapsed_string($start, $end, $full = false) {
        $now = new DateTime($end);
        $ago = new DateTime($start);
        $diff = $now->diff($ago);
        return $diff;
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    if (! function_exists('array_month')) {
       function array_month()
       {
            return array(
                1 => trans('month.january'),
                2 => trans('month.february'),
                3 => trans('month.march'),
                4 => trans('month.april'),
                5 => trans('month.may'),
                6 => trans('month.june'),
                7 => trans('month.july'),
                8 => trans('month.august'),
                9 => trans('month.september'),
                10 => trans('month.october'),
                11 => trans('month.november'),
                12 => trans('month.december')
            );
       }
    }
}

if (!function_exists('recursive_select_option')) {
    function recursive_select_option(Illuminate\Support\Collection $collection, $indentChar = '') {
        $html = '';

        foreach ($collection as $key => $item) {
            $html .= '<option value="' . $item->id . '">';
            $html .=  $indentChar . $item->name;
            $html .= '</option">';

            if (!$item->children->isEmpty()) {
                // $html .= '<optgroup label="' . $indentChar . $item->name . '">';


                $indentChar .= '&nbsp;';
                $html .= recursive_select_option($item->children, $indentChar);
                // $html .= '</optgroup>';

            // } else {
                $html .= '<option value="' . $item->id . '">';
                $html .=  $indentChar . $item->name;
                $html .= '</option">';
            }
        }

        return $html;
    }
}

if (!function_exists('recursive_nestable')) {
    function recursive_nestable(Illuminate\Support\Collection $collection) {
        $html = '';

        foreach ($collection as $key => $item) {
            if($item->is_active) {
                $status_active = 'active';
            } else {
                $status_active = 'non active';
            }
            $html .='<li class="dd-item" data-id="'. $item->id. '">
                        <div class="dd-handle"><span class="badge">' . $item->id . '</span> ' . $item->name .'
                            <span class="pull-right">
                                <span class="badge" style="margin-right: 50px">'.  $status_active .'</span>
                                <a
                                    href=""
                                    class="btn-add"
                                    data-id="' . $item->id . '"
                                    data-parent-id="' . $item->parent_id . '"
                                    data-description="' . $item->description . '"
                                >
                                    <i class="fa fa-plus">
                                    </i>
                                </a>
                                &nbsp;
                                <a
                                    href=""
                                    class="btn-edit"
                                    data-id="' . $item->id . '"
                                    data-name="' . $item->name . '"
                                    data-parent-id="' . $item->parent_id . '"
                                    data-description="' . $item->description . '"
                                    data-order="' . $item->order . '"
                                    data-is-active="' . $item->is_active . '"
                                    data-start-date="' . $item->start_date . '"
                                    data-end-date="' . $item->end_date . '"
                                    data-image="' . $item->image . '"
                                >
                                    <i class="fa fa-pencil">
                                    </i>
                                </a>
                                &nbsp;
                                <a href="" class="btn-delete" data-id="' . $item->id . '">
                                    <i class="fa fa-trash">
                                    </i>
                                </a>
                            </span>
                        </div>';
            if (!$item->children->isEmpty()) {
                $html .= '<ol class="dd-list">';
                $html .= recursive_nestable($item->children);
                $html .= '</ol>';
            }

            $html .= '</li>';
        }

        return $html;
    }
}

if (! function_exists('getInfoAgentLoggedIn')) {
    /**
     * Get data agent that currently loggen in.
     *
     * @param  null
     * @return Models\Agent
     */
    function getInfoAgentLoggedIn()
    {
        return Agent::where('email', user_info('email'))->with(['salesmans'])->first();
    }
}

if (! function_exists('labelStatus')) {
    function labelStatus($type = 'close', $text = '') {

        switch($type) {
            case 'canceled':
                $class = 'danger';
                break;
            case 'close':
                $class = 'success';
                break;
            case 'open':
                $class = 'primary';
                break;
            case 'partial':
                $class = 'info';
                break;
            case 'pending':
                $class = 'warning';
                break;
            default:
                $class = 'default';
        }

        return '<span class="label label-' . $class . '">' . $text . '</span>';

    }
}

