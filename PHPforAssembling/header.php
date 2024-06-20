<?
session_start();
require_once "PHPscripts\\dbConnect.php";
$sth = $db->query("SELECT id_project, project_name, url_read FROM mainschem.projects");
$quantityProjects = $sth->rowCount();
$json = json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
$obj = json_decode($json, true);

$sth = $db->query("SELECT id_user, avatar FROM mainschem.account WHERE nickname = " . $db->quote($_SESSION['nickname']));
$jsonForProfile = json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
$objProfile = json_decode($jsonForProfile, true);
?>
<header>
    <div id = "menu-button">
        <button class="burger"></button>
    </div>
    <div class = 'head-left'>
        <div id = "main-link"><span>главная</span></div>
        <div tabindex = "0" class = "search">
            <div class = "search-input">
                <input type = "text" id = "elastic" placeholder = "Поиск...">
            </div>
            <div class = "elastic elastic-hide">
                <?for($i = 0; $i < $quantityProjects; $i++){
                    echo ('<div id = "project-'. $i . '">' . $obj[$i]['project_name'] . '</div>');
                }?>
            </div>
        </div>
    </div>
    <div class = 'head-right'>
        <div id = "swapper">
            <div class = "switch-btn switch-on" style="margin: 10px;"></div>
        </div>
        <div id = "acc">
            <div id = "profile">
                <?php
                if ($_SESSION['nickname'] !== ''){?>
                    <div id = "profile-photo">
                        <img src = "IMG\\PROFILE_PHOTO\\<?
                        if ($objProfile[0]['avatar'] == 'true')
                            echo $objProfile[0]['id_user'] . '.png';
                        else{
                            echo 'noavatar.png';
                        } 
                        ?>">
                    </div>
                    <div id = "profile-nick">
                        <?php echo $_SESSION['nickname'] ?>
                    </div>
                <?} else {?>
                    <div id = "profile-nick">войти</div>
                <?}?>
            </div>
            <?php
                if ($_SESSION['nickname'] !== ''){?>
            <div id = "acc-menu">
                <div class = "acc-menu-plate">Закладки</div>
                <?if($_SESSION['editor']){?>
                    <div class = "acc-menu-plate" id = "add-project">Добавить проект</div>
                <?}?>
                <div class = "acc-menu-plate" id = "exit">Выход</div>
            </div>
            <script>
                document.getElementById("add-project").addEventListener("click", function(){
                    window.location.href = "addProject.php";
                });

                document.getElementById('exit').addEventListener("click", function(){
                    window.location.href = 'PHPscripts\\exit.php';
                });
            </script>
            <?}?>
        </div>
    </div>
</header>
<script>
    const burger = document.querySelector('.burger');
    const header_left = document.querySelector('.head-left');
    const header_right = document.querySelector('.head-right');
    const header = document.querySelector('header');
    
    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        if(burger.classList.contains('active')){
            header_left.style.display = 'flex';
            header_right.style.display = 'flex';
            header.style.height = '200px';
            window.dispatchEvent(new Event('resize'));
        } else{
            header_left.style.display = 'none';
            header_right.style.display = 'none';
            header.style.height = '40px';
            window.dispatchEvent(new Event('resize'));
        }
    });

    window.addEventListener('resize', function(){
        if (header.offsetWidth > 900){ 
            burger.classList.remove('active');
            header.style.height = '40px';
            window.dispatchEvent(new Event('resize'));
        }
    });


    document.getElementsByClassName('switch-btn')[0].addEventListener("click", function() {
        this.classList.toggle('switch-on');
        document.documentElement.classList.toggle('light-theme');
    });
    
    document.getElementById('profile').addEventListener("click", function(){
            window.location.href = 'acc.php?reg=0';
    });

    let nickname = '<?echo $_SESSION['nickname']?>';
    if(nickname !== ''){
        let menu = document.getElementById('acc-menu');
        document.getElementById('acc').addEventListener("mouseover", function(){
            menu.style.display = 'flex';
        });
        document.getElementById('acc').addEventListener("mouseout", function(){
            menu.style.display = 'none';
        });
    };
    document.querySelector('#main-link span').addEventListener("click", function(){
        window.location.href = 'index.php';
    });


    document.getElementsByClassName('search')[0].addEventListener("focusin", function(){
        document.getElementsByClassName('elastic')[0].classList.remove('elastic-hide');
    });

    document.getElementsByClassName('search')[0].addEventListener("focusout", function(){
        document.getElementsByClassName('elastic')[0].classList.add('elastic-hide');
    });

    document.getElementById('elastic').oninput = function() {
        let val = this.value.trim();
        let elasticItems = document.querySelectorAll('.elastic div');
        if (val != ''){
            elasticItems.forEach(function(elem){
                if(elem.innerText.search(val) == -1){
                    elem.classList.add('hide');
                }
                else{
                    elem.classList.remove('hide');
                }
            });
        }
        else{
            elasticItems.forEach(function(elem){
                 elem.classList.remove('hide');
            });
        }
    };

    function translit(word){
        var converter = {
            'а': 'a',    'б': 'b',    'в': 'v',    'г': 'g',    'д': 'd',
            'е': 'e',    'ё': 'e',    'ж': 'zh',   'з': 'z',    'и': 'i',
            'й': 'y',    'к': 'k',    'л': 'l',    'м': 'm',    'н': 'n',
            'о': 'o',    'п': 'p',    'р': 'r',    'с': 's',    'т': 't',
            'у': 'u',    'ф': 'f',    'х': 'h',    'ц': 'c',    'ч': 'ch',
            'ш': 'sh',   'щ': 'sch',  'ь': '',     'ы': 'y',    'ъ': '',
            'э': 'e',    'ю': 'yu',   'я': 'ya'
        };
    
        word = word.toLowerCase();
    
        var answer = '';
        for (var i = 0; i < word.length; ++i ) {
            if (converter[word[i]] == undefined){
                answer += word[i];
            } else {
                answer += converter[word[i]];
            }
        }
    
        answer = answer.replace(/[^-0-9a-z]/g, '-');
        answer = answer.replace(/[-]+/g, '-');
        answer = answer.replace(/^\-|-$/g, ''); 
        return answer;
    }


    let items = <?echo json_encode($json)?>;
    items = JSON.parse(items);
    document.querySelectorAll('.elastic div').forEach(function(project) {
        let idElem = project.id.slice(-1);
        project.addEventListener("click", function (){
            window.location.href = 'projectPage.php?id=' + items[idElem]['id_project'];
        });
    });
</script>
