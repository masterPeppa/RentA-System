<?php
    //Connection of database
    include('../../DataBase/connection.php');
    $folderPath = '../../imgs/properties/';
    $folderFiles = array_filter(scandir($folderPath), function($item) {
        return !in_array($item, ['.', '..']);
    });

    $getImageDirectory = "SELECT * FROM landing_properties";
    $directoryResult = mysqli_query($con, $getImageDirectory);

    $getImageDirectory1 = "SELECT * FROM landing_properties_new";

    $directoryResult1 = mysqli_query($con, $getImageDirectory1);
    $dirfetch1 = mysqli_fetch_assoc($directoryResult1);

    $databaseFiles = [];

    if ($directoryResult) {

        while ($dirfetch = mysqli_fetch_assoc($directoryResult)) {
            
            for ($i = 0; $i < count($amenitiesCheckData); $i++) {
                $dir1 = trim($amenitiesCheckData[$i]."1");
                $dir2 = trim($amenitiesCheckData[$i]."2");
                if (!empty($dirfetch[$amenitiesCheckData[$i]])) {
                    $databaseFiles[] = basename($dirfetch[$amenitiesCheckData[$i]]);
                    $databaseFiles[] = basename($dirfetch1[$dir1]);
                    $databaseFiles[] = basename($dirfetch1[$dir2]);
                }
            }
            if (!empty($dirfetch['imgFeatured1'])) {
                $databaseFiles[] = basename($dirfetch['imgFeatured1']);
            }
            if (!empty($dirfetch['imgFeatured2'])) {
                $databaseFiles[] = basename($dirfetch['imgFeatured2']);
            }
            if (!empty($dirfetch['imgFeatured3'])) {
                $databaseFiles[] = basename($dirfetch['imgFeatured3']);
            }
        }

    } else {
        echo "Database query failed: " . mysqli_error($con);
    }

    $folderFiles = array_map('trim', $folderFiles);
    $databaseFiles = array_map('trim', $databaseFiles);
    $filesToDelete = array_diff($folderFiles, $databaseFiles);

        foreach ($filesToDelete as $file) {
            $filePath = $folderPath . $file;
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
?>