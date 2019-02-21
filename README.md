# SqlFileLoader
Read the SQL file, remove all comments, and separate each command for manipulation.
# Instation
Put in your composer file the command bellow.
```
"pedrosoares/sqlfileloader": "1.0.*"
```
The field "require" shoud be like:
```
"require": {
    "php": ">=5.5.9",
    "laravel/framework": "5.1.*",
    "pedrosoares/sqlfileloader": "1.0.*"
}
```

# How use
To load a file and get all sql commands, you can do in this way:
```
$c = new SqlFileLoader("PATH to the sql file");
foreach($c->getStatements() as $sqlCommand){
    DB::statement($sqlCommand);
}
```
