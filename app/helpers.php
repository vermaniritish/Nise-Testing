<?php
use App\Models\Admin\Settings;
use App\Models\Admin\Pages;
use Illuminate\Support\Carbon;

function _dt($datetime)
{
	$dateFormat = Settings::get('date_format');
	$timeFormat = Settings::get('time_format');

	return date($dateFormat . ' ' . $timeFormat, strtotime($datetime));
}

function _d($date)
{
	$dateFormat = Settings::get('date_format');
	return date($dateFormat, strtotime($date));
}
 function formatDate($date)
{
    return Carbon::parse($date)->format('d M Y');
}

function _time($time)
{
	$timeFormat = Settings::get('time_format');
	return date($timeFormat, strtotime($time));
}

function _t($time)
{
	return date("H:i", strtotime($time));
}

function time_ago($time)
{
	$date = new Carbon($time);
    return $date->diffForHumans();
}

function get_controller_action()
{
	$action = request()->route()->getAction()['controller'];
	$action = explode('\\', $action);
	$action = end($action);
	$action = explode('@', $action);
	$controller = str_replace('Controller', '', $action[0]);
	$controller = strtolower(substr($controller, 0, 1)) . substr($controller, 1);
	$action = $action[1];
	return $controller . '/' . $action;
}

function _money($amount, $dec = null)
{
	return '₹' . number_format($amount, $dec !== null ? $dec : 2);
}

function getReligions()
{
  return [
    [
      'title' => 'Hindu',
      'slug' => 'hindu'
    ],
    [
      'title' => 'Muslim',
      'slug' => 'muslim'
    ],
    [
      'title' => 'Sikh',
      'slug' => 'sikh'
    ],
    [
      'title' => 'Christian',
      'slug' => 'christian'
    ],
    [
      'title' => 'Jainiusm',
      'slug' => 'jainiusm'
    ],
    [
      'title' => 'Buddhism',
      'slug' => 'buddhism'
    ]
    ];
}

function getLogo(){
    $record = Pages::with('customPageData')->where('slug', 'home')->first();
    $websiteLogo = $record->customPageData->where('key', 'website_logo')->first();
    return $websiteLogo->value;
}


function renderVideoEmbed($url) {
    // Check if it's a YouTube URL
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\s&]+)/', $url, $matches)) {
        $videoId = $matches[1];
        return '<iframe width="100%" height="215" src="https://www.youtube.com/embed/' . htmlspecialchars($videoId) . '" frameborder="0" allowfullscreen></iframe>';
    }

    // Check if it's a direct video file (like .mp4)
    if (preg_match('/\.(mp4|webm|ogg)$/i', $url)) {
        return '<video width="100%" height="215" controls>
                    <source src="' . htmlspecialchars($url) . '" type="video/mp4">
                    Your browser does not support the video tag.
                </video>';
    }

    // Fallback if unknown
    return '<p>Invalid or unsupported video format.</p>';
}