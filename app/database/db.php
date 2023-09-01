<?php
    session_start();
    require ('connect.php');

    function tt($value) {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

    //Провірка запроса до БД
    function dbCheckError($query) {
        $err = $query -> errorInfo();
        if($err[0] !== PDO::ERR_NONE) {
            echo $err[2]; 
            exit();
        }
        return true;
    }

    //Запит на отримання даних  
    function selectAll($table, $params = []) {
        global $connect;
        $sql = "SELECT * FROM $table";

        if(!empty($params)) {
            $i = 0;
            foreach($params as $key => $value) {
                if(!is_numeric($value)) {
                    $value = "'".$value."'";     
                }
                if ($i === 0) {
                    $sql = $sql . " WHERE $key = $value";     
                }else {
                    $sql = $sql . " AND $key = $value"; 
                }   
                $i++;  
            }          
        }

        $query = $connect -> prepare($sql);
        $query -> execute();
        dbCheckError($query);        
        return $query -> fetchAll();
    }

    //Запит на отримання одного рядка з таблиці  
    function selectOne($table, $params = []) {
        global $connect;
        $sql = "SELECT * FROM $table";

        if(!empty($params)) {
            $i = 0;
            foreach($params as $key => $value) {
                if(!is_numeric($value)) {
                    $value = "'".$value."'";     
                }
                if ($i === 0) {
                    $sql = $sql . " WHERE $key = $value";     
                }else {
                    $sql = $sql . " AND $key = $value"; 
                }   
                $i++;  
            }          
        }

        // $sql = $sql . " LIMIT 1";
        $query = $connect -> prepare($sql);
        $query -> execute();
        dbCheckError($query);
        return $query -> fetch();
    }

    // Запис в таблицю БД

    function insert ($table, $params) {
        global $connect;
        $i = 0;
        $col = '';
        $mask = '';
        foreach($params as $key => $value) {
            if($i === 0) {
                $col = $col . "$key";
                $mask = $mask . "'" . "$value" . "'";   
            }else {
                $col = $col . ", $key";
                $mask = $mask . ", '" . "$value" . "'";
            }
            $i++;
        }

        $sql = "INSERT INTO $table ($col) VALUES ($mask)";

        $query = $connect -> prepare($sql);
        $query -> execute($params);
        dbCheckError($query);
        return $connect -> lastInsertId();
    }

    //Оновлення таблиці
    function update ($table, $id, $params) {
        global $connect;
        $i = 0;
        $str = '';
        foreach($params as $key => $value) {
            if($i === 0) {
                $str = $str . $key . " = '" . $value . "'";
            }else {
                $str = $str .", " . $key . " = '" . $value . "'";
            }
            $i++;
        }

        $sql = "UPDATE $table SET $str WHERE id = $id";

        $query = $connect -> prepare($sql);
        $query -> execute($params);
        dbCheckError($query);
    }

    //Видалення даних
    function delete ($table, $id) {
        global $connect;

        $sql = "DELETE FROM $table WHERE id = $id";

        $query = $connect -> prepare($sql);
        $query -> execute();
        dbCheckError($query);
    }

    //Витяг записів з автором 
    function selectAllFromPostsWithUsers($table1, $table2) {
        global $connect;

        $sql = "SELECT t1.id, t1.title, t1.image, t1.content, t1.status, t1.id_topic, t1.create_date, 
        t2.username FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";

        $query = $connect -> prepare($sql);
        $query -> execute();
        dbCheckError($query);
        return $query -> fetchAll();
    }

    //Витяг записів з автором на головну
    function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset) {
        global $connect;
        $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status = 1 LIMIT $limit OFFSET $offset";
        $query = $connect -> prepare($sql);
        $query -> execute();
        dbCheckError($query);
        return $query -> fetchAll();
    }

    function selectTopTopicsFromPostsOnIndex($table1) {
        global $connect;
        $sql = "SELECT * FROM $table1 WHERE id_topic = 9";
        $query = $connect -> prepare($sql);
        $query -> execute();
        dbCheckError($query);
        return $query -> fetchAll();
    }

    function search($text, $table1, $table2) {
        global $connect;
        $text = trim(strip_tags(stripcslashes(htmlspecialchars($text)))); 
        $sql = "SELECT p.*, u.username 
                FROM $table1 AS p 
                JOIN $table2 AS u 
                ON p.id_user = u.id 
                WHERE p.status = 1
                AND p.title LIKE '%$text%' OR p.content LiKE '%$text%'";
        $query = $connect -> prepare($sql);
        $query -> execute();
        dbCheckError($query);
        return $query -> fetchAll();
    }

        //Витяг записа з автором для сингл
        function selectPostFromPosts($table1, $table2, $id) {
            global $connect;
            $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $id";
            $query = $connect -> prepare($sql);
            $query -> execute();
            dbCheckError($query);
            return $query -> fetch();
        }

        function countRow($table) {
            global $connect;
            $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";
            $query = $connect -> prepare($sql);
            $query -> execute();
            dbCheckError($query);
            return $query -> fetchColumn();
        }

        //Витяг даних для нумерації з категоріями
        function selectAllFromNumericWithCategory($table1, $table2, $limit, $offset, $id) {
            global $connect;
            $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id
                    WHERE p.status = 1 AND p.id_topic = $id LIMIT $limit OFFSET $offset";
            $query = $connect -> prepare($sql);
            $query -> execute();
            dbCheckError($query);
            return $query -> fetchAll();
        }