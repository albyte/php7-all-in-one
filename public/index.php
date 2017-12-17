<?php
require '../src/ChordTranspose.php';
/**
 * @param $key
 * @param string $default
 * @return string
 */
function param($key, $default = '')
{
    return array_key_exists($key, $_REQUEST)
        ? $_REQUEST[$key]
        : $default;
}

/**
 * @param $name
 * @param $value
 */
function make_select($name, $value)
{
    echo '<select name="' . $name . '">';
    foreach (['major' => '', 'minor' => 'm'] as $group => $suffix) {
        printf('<optgroup label="%s">', $group);
        foreach (ChordTranspose::CHORDS as $chord) {
            $chord = $chord . $suffix;
            $selected = ($value == $chord) ? ' selected' : '';
            printf('<option value="%s"%s>%s</option>', $chord, $selected, $chord);
        }
        echo '</optgroup>';
    }
    echo '</select>';
}

$src = param('src', 'C');
$dst = param('dst', 'C');

$text = param('text', <<<TEXT
|  G  |  G  |  Em | Em |
|  C  |  D7 |  G  | G  |
TEXT
);
$error = '';
if (!empty($src) && !empty($dst) && !empty($text)) {
    try {
        $transpose = new ChordTranspose();
        $text = $transpose->setDistance($src, $dst)->transposeChordText($text);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chord Transpose</title>
</head>
<body>
<h1>Chord Transpose</h1>
<form method="post">
    <div>
        src key:
        <?php make_select('src', $src); ?>
    </div>
    <div>
        dst key:
        <?php make_select('dst', $dst); ?>
    </div>
    <div>
        <textarea name="text" rows="8" cols="100"><?= $text ?></textarea>
    </div>
    <div>
        <button type="submit">transpose</button>
    </div>
</form>
<div style="color:red"><?= $error ?></div>
</body>

</html>
