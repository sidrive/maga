<?php
require_once("koneksi.php");
    if (!isset($_SESSION)) {
        session_start();
    }
     
    if (isset($_GET['act']) && isset($_GET['ref'])) {
        $act = $_GET['act'];
        $ref = $_GET['ref'];
		$val = $_GET['VAL'];
             
        if ($act == "add") {
            if (isset($_GET['KODE_BRG'])) {
                $barang_id = $_GET['KODE_BRG'];
                if (isset($_SESSION['items'][$barang_id])) {
                    $_SESSION['items'][$barang_id] += 1;
                } else {
                    $_SESSION['items'][$barang_id] = $val; 
                }
            }
        } elseif ($act == "plus") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
				$val = $_GET['val'];
                if (isset($_SESSION['items'][$barang_id])) {
                    $_SESSION['items'][$barang_id] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['items'][$barang_id])) {
                    $_SESSION['items'][$barang_id] -= 1;
					
                }
            } 
        } elseif ($act == "del") {
            if (isset($_GET['barang_id'])) {
                $barang_id = $_GET['barang_id'];
                if (isset($_SESSION['items'][$barang_id])) {
                    unset($_SESSION['items'][$barang_id]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $val) {
                    unset($_SESSION['items'][$key]);
                }
                unset($_SESSION['items']);
            }
        } 
         
        header ("location:" . $ref);
    }
?>