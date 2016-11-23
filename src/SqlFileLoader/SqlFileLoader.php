<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 11/23/16
 * Time: 1:50 PM
 */

namespace PedroSoares\SqlFileLoader;

use \Illuminate\Support\Facades\File;

class SqlFileLoader {

    //List of statements on SQL File
    private $statements = NULL;

    public function __construct($filepath) {
        //Verify if file not exist
        if(!File::exists($filepath)){
            //Send exception if file not exists
            throw new \Illuminate\Contracts\Filesystem\FileNotFoundException("File: \"".$filepath."\" not exist!");
        }
        //Load data from file to variable
        $data = File::get($filepath);
        //Remove comments and separete each sql command
        $this->statements = array_filter(array_map('trim', explode(';', $this->unComment($data))));
        //Add ';' to end of each sql command
        foreach ($this->statements as &$sql) {
            $sql .= ";";
        }
    }

    //Get all staments of my file
    public function getStatements(){
        return $this->statements;
    }

    //Function to return migration PAth with File
    public static function MIGRATION($filepath){
        return "database/migrations".$filepath;
    }

    //Function resposable to remove comments of SQL block
    private function unComment($sql){
        $sqlComments = '@(([\'"]).*?[^\\\]\2)|((?:\#|--).*?$|/\*(?:[^/*]|/(?!\*)|\*(?!/)|(?R))*\*\/)\s*|(?<=;)\s+@ms';
        $uncommentedSQL = trim( preg_replace( $sqlComments, '$1', $sql ) );
        preg_match_all( $sqlComments, $sql, $comments );
        return preg_replace('/[\x00-\x1F\x80-\xFF]/', '', trim($uncommentedSQL));
    }

}