<?php
session_start();

$_typeUser = [2 => "employe", 3 => "user_subscriber"]; 
$_statutUser = ["non actif", "actif"];

$update =   '<picture>
              <svg height="23px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" class="update-admin">
                <g transform="matrix(0.607143,0,0,0.607143,0.785712,0.785712)">
                    <g id="spin">
                        <g>
                          <path d="M25.883,6.086L23.063,8.918C24.953,10.809 26,13.324 26,16C26,21.516 21.516,26 16,26L16,24L12,28L16,32L16,30C23.719,30 30,23.719 30,16C30,12.254 28.539,8.734 25.883,6.086Z"/>
                          <path d="M20,4L16,0L16,2C8.281,2 2,8.281 2,16C2,19.746 3.461,23.266 6.117,25.914L8.937,23.082C7.047,21.191 6,18.676 6,16C6,10.484 10.484,6 16,6L16,8L20,4Z"/>
                        </g>
                    </g>
                </g>
              </svg>
            </picture>';

$delete =   '<picture>
              <svg height="23px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" class="delete-admin">
                  <g transform="matrix(0.0371094,0,0,0.0371094,-199.781,-246)">
                      <g transform="matrix(1,0,0,1,5397.05,6642.53)">
                        <path d="M424,64L336,64L336,48C336,21.533 314.467,0 288,0L224,0C197.533,0 176,21.533 176,48L176,64L88,64C65.944,64 48,81.944 48,104L48,160C48,168.836 55.164,176 64,176L72.744,176L86.567,466.283C87.788,491.919 108.848,512 134.512,512L377.488,512C403.153,512 424.213,491.919 425.433,466.283L439.256,176L448,176C456.836,176 464,168.836 464,160L464,104C464,81.944 446.056,64 424,64ZM208,48C208,39.178 215.178,32 224,32L288,32C296.822,32 304,39.178 304,48L304,64L208,64L208,48ZM80,104C80,99.589 83.589,96 88,96L424,96C428.411,96 432,99.589 432,104L432,144L80,144L80,104ZM393.469,464.761C393.062,473.306 386.042,480 377.488,480L134.512,480C125.957,480 118.937,473.306 118.531,464.761L104.78,176L407.22,176L393.469,464.761Z" style="fill-rule:nonzero;"/>
                      </g>
                      <g transform="matrix(1,0,0,1,5397.05,6636.63)">
                        <path d="M256,448C264.836,448 272,440.836 272,432L272,224C272,215.164 264.836,208 256,208C247.164,208 240,215.164 240,224L240,432C240,440.836 247.163,448 256,448Z" style="fill-rule:nonzero;"/>
                      </g>
                      <g transform="matrix(1,0,0,1,5397.89,6636.63)">
                        <path d="M336,448C344.836,448 352,440.836 352,432L352,224C352,215.164 344.836,208 336,208C327.164,208 320,215.164 320,224L320,432C320,440.836 327.163,448 336,448Z" style="fill-rule:nonzero;"/>
                      </g>
                      <g transform="matrix(1,0,0,1,5396.21,6636.63)">
                        <path d="M176,448C184.836,448 192,440.836 192,432L192,224C192,215.164 184.836,208 176,208C167.164,208 160,215.164 160,224L160,432C160,440.836 167.163,448 176,448Z" style="fill-rule:nonzero;"/>
                      </g>
                  </g>
              </svg>
            </picture>';
  
    require_once("../Config/config.php");

    /*if (!isset($_SESSION['uniqId'])) {
        header('Location: ' .ACCUEIL);
        exit;
    }*/

    require_once("../View/header_page.php");
    require_once("../controller/process_logout.php");
?>

    <body>

        <?php
            require_once("../View/home_menu.php");
        ?>

        <?php 
        if (isset($_SESSION["uniqId"]) && $_SESSION["level"] < 2) {
            require_once("interfaces_administrations/content_admin.php");
        } else if (isset($_SESSION["uniqId"]) && $_SESSION["level"] === 2) {
            require_once("interfaces_administrations/content_admin_employe.php");
          } else if (isset($_SESSION["uniqId"]) && $_SESSION["level"] > 2) {
              require_once("interfaces_administrations/content_admin_subscriber.php");
            }
        ?>

        <script src="<?php echo JQUERY; ?>"></script>
        <script src="<?php echo BOOTSTRAP_JS; ?>"></script>
        <script src="<?php echo INDEX_JS; ?>"></script>
        <script src="<?php echo ADMIN_JS; ?>"></script>

    </body>

</html>