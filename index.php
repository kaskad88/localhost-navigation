<?php
$projectsListIgnore = array( '.', '..' );
$img_formats        = array( 'jpg', 'png' );

$handle          = opendir( "." );
$projectContents = '';

while ( $file = readdir( $handle ) ) {

	if ( is_dir( $file ) && $file == '..' ) {
		$projectBefore = '<a class="back" href="' . $file . '">Back</a>';
	}
	if ( is_dir( $file ) && ! in_array( $file, $projectsListIgnore ) ) {

		$img_src = '';

		foreach ( $img_formats as $format ) {

			$__img_src     = $file . '.' . $format;
			$__old_img_src = $file . '/scr.' . $format;

			if ( file_exists( $__img_src ) ) {
				$img_src = $__img_src;
				break;
			} elseif ( file_exists( $__old_img_src ) ) {
				$img_src = $__old_img_src;
				break;
			}
		}

		if ( ! file_exists( $img_src ) ) {
			$img_src = sprintf( 'http://fakeimg.pl/200x175/0073AA/fff/?text=%1$s&font=bebas', $file );
		}

		$projectContents .= '<li><a href="' . $file . '" class="img-link">';
		$projectContents .= '<figure class="img"><img src="' . $img_src . '" width="200" /><figcaption>' . $file . '</figcaption></figure>';

		if ( file_exists( $file . '/wp-admin' ) ) {
			$projectContents .= '</a><a href="' . $file . '/wp-admin/" class="admin-link">Admin</a></li>';
		} else {
			$projectContents .= '</a></li>';
		}
	}
}
closedir( $handle );

if ( ! isset( $projectContents ) ) {
	$projectContents = 'Пока еще пусто';
}

function head_title() {
	$path_info = pathinfo( __DIR__ );
	
	echo $path_info['basename'];
}

?>
<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
	<title><?php head_title(); ?></title>
	<meta http-equiv="Content-Type" content="txt/html; charset=utf-8" />

	<style type="text/css">

		:root {
			--primary-color: #0073AA;
			--gray-color: #E0E0E0;
			--text-color: #555555;
		}

		body {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			padding: 1%;
			color: var(--text-color);
		}

		a {
			outline: none;
			color: inherit;
			transition: .2s;
			text-decoration: none;
		}

		a.back {
			font-size: 16px;
			font-weight: bold;
			display: inline-block;
			padding: 10px 30px;
			background: var(--gray-color);
			clear: both;
		}

		a.back:hover {
			background: var(--primary-color);
			color: #fff;
		}

		ul {
			display: flex;
			flex-flow: row wrap;
			list-style: none;
			padding: 20px;
			font-size: 1em;
			overflow: hidden;
		}

		ul li {
			flex: 0 0 200px;
			width: 200px;
			border: 3px solid var(--gray-color);
			background: var(--gray-color);
			margin: 5px;
			text-align: center;
		}

		ul li a.img-link {
			display: block;
			font-weight: bold;
		}

		ul li a.img-link:hover{
			background: #000;
			color: #fff;
		}

		ul li figure {
			display: block;
			overflow: hidden;
			margin: 0;
			width: 200px;
		}

		ul li img {
			height: 175px;
			object-fit: cover;
			display: block;
			vertical-align: top;
		}

		ul li figcaption {
			display: block;
			padding: 5px;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}

		a.admin-link {
			color: #009900;
			font-weight: bold;
			padding: 4px;
			display: inline-block;
		}
		a.admin-link:hover {
			background: #009900;
			color: #FFFFFF;
		}

	</style>
</head>

<body>
<?php echo $projectBefore; ?>
<ul>
	<?php echo $projectContents; ?>
</ul>
<?php echo $projectBefore; ?>
</body>