<?php
/*
copyright @ medantechno.com
Modified by Ilyasa
2017
*/
require_once('./line_class.php');
$channelAccessToken = 'tlXeZwXdVCeXtyV6ZGvSDYfnD8upjcG0A0QDPPpdd4/KF9Hv8HlrqRrenUPJ+pT3QC6GwaAe80S7N0PdIQXfcfcUGelayn4BvkSyIBzH0tYpnvTUfsNUyNl1mrPkjKR4lyeyiV7R2ZZN2rU66xxi1AdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = 'c93ee63aa925f08836a0843b0ea5dd76';//sesuaikan
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$userId 	=Issue $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$profil = $client->profil($userId);
$pesan_datang = $message['text'];
if($message['type']=='kontak')
{	
	$balas = array(
							'UserID' => $profil->userId,	
                                                        'replyToken' => $replyToken,							
							'messages' => array(
								array(
										'type' => 'text',									
										'text' => 'Terima Kasih Stikernya.'										
									
									)
							)
						);
						
}
else
$pesan=str_replace(" ", "%20", $pesan_datang);
$key = 'f1830f11-af68-49ef-bbc8-c4308cbf4d20'; //API SimSimi
$url = 'http://sandbox.api.simsimi.com/request.p?key='.$key.'&lc=id&ft=1.0&text='.$pesan;
$json_data = file_get_contents($url);
$url=json_decode($json_data,1);
$diterima = $url['response'];
if($message['type']=='text')
{
if($url['result'] != 100)
	{
		
		
		$balas = array(
							'UserID' => $profil->userId,
                                                        'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => ''
									)
							)
						);
				
	}
	else{
		$balas = array(
							'UserID' => $profil->userId,
                                                        'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => ''.$diterima.''
									)
							)
						);
						
	}
}
 
$result =  json_encode($balas);
file_put_contents('./reply.json',$result);
$client->replyMessage($balas);
