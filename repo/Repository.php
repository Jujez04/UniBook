<?php 

interface Repository {
    public function delete(&$dao);

    public function save(&$dao);

    public function create(&$dao);
}

?>