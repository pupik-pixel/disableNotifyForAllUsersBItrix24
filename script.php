<?

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;

Loader::includeModule('im');

$users = UserTable::getList([
    'select' => [
        '*'
    ]
])->fetchAll();

foreach ($users as $user) {
    /**
     * Авторизация обязательна, иначе новые настройки не применятся
     */
    $USER->Authorize($user['ID']);
    $settings = CIMSettings::Get($user['ID'])['settings'];

    if ($settings['notifySchemeSendEmail'] == true) {
        $settings['notifySchemeSendEmail'] = false;
        CIMSettings::SetSetting(CIMSettings::SETTINGS, $settings);
    }
}
