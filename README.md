# Zip_Manager
This class was created by me to simplify the work with zip archives. Its use is quite simple. The best theory is practice, so consider the rules for working with Zip_Manager

# Exapmles
## Initializing a class
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
```

## Creating an archive
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $array_files = array('1.jpg','some.txt');
  $zip->create_archive('some_folder',array_files);
```

## Adding a files to the archive
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $files = array('file1.txt','file2.jpg');
  $zip->add_files($files);
```

## Deleting a file from the archive
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $zip->remove_file('some_file_from_archive');
```

## Renaming a file in an archive
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $zip->rename_file('old_name','new_name');
```

## Checking for a file
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $zip->in_archive('some_file');
```

## Reading a file from the archive
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $zip->read_file('some_file');
```

## Extracting a file from the archive
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $array_elems = array('some_file_from_archive');
  $zip->extruct('destination_dir',array_elems);
```
## Viewing the contents of the archive
```php
  include('Zip_Manager.php');
  
  $zip = Zip_Manager::App('some_archive.zip');
  $zip->content_archive();
```
