<?php 
use App\Models\Admin\Settings; 
$companyName = Settings::get('company_name');
$logo = Settings::get('logo');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $companyName; ?></title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #eee;
        }
    </style>

</head>

<body>

    <div>
        <div style="background-color: #eee; ">
            <table style="width: 660px; margin: 0 auto; background-color: #eee; font-family: sans-serif;">
                <tbody>
                    <tr>
                        <td>
                            <h2 style="font-weight: 800; font-size: 36px;text-align: center; margin: 30px 0 20px;">
                                <?php if($logo): ?>
                                    <img src="<?php echo url($logo) ?>" style="max-width: 200px; max-height: 200px;">
                                <?php else: ?>
                                    <?php echo $companyName ?>
                                <?php endif; ?>
                                
                                
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #fff; border-radius: 16px; text-align: center; padding: 60px 40px;">
                            <?php echo $content ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>