<?php
  /*
    각 갤러리별 개념글 미리보기 mip을 가공하는 파일입니다.
    여기서 가공이란 "리스트(나열)"로 만드는 것을 뜻 합니다.
    이 곳에서 만들어진 리스트는 ../pop.php에서 사용합니다.
  */
?>

<?php
  /*
    4개의 갤러리에서 각 5개의 글 데이터를 가져와 삽입해야 합니다.
    
    $data = [
      {
        gallery = ;
        articles = [
          {
            id: '',
            title: '',
            gallery: '',
          }
        ];
      },
      {
        gallery = ;
        articles = [
          {
            id: '',
            title: '',
            gallery: '',
          }
        ];
      },
      {
        gallery = ;
        articles = [
          {
            id: '',
            title: '',
            gallery: '',
          }
        ];
      },
      {
        gallery = ;
        articles = [
          {
            id: '',
            title: '',
            gallery: '',
          }
        ];
      },
    ];
    
    <?php
      foreach ($data as $rData) {
        forech ($rData as $article) {
          $id = $article.id;
          $title = $article.title;
          $gallery = $article.gallery;
          require __DIR__ . '/../raw/pop.php'; // ../raw/pop.php에서 변수 $id, $title, $gallery등을 받아 raw html에 정보들을 주입합니다.
        }
      }   
    ?>
  */

  require __DIR__ . '/../raw/pop.php';
  require __DIR__ . '/../raw/pop.php';
  require __DIR__ . '/../raw/pop.php';
  require __DIR__ . '/../raw/pop.php';
?>