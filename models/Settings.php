<?php

    namespace Martin\Adminer\Models;

    use Model;
    use Lang;

    use Martin\Adminer\Classes\OctoberAdminerHelper;

    class Settings extends Model {

        use \October\Rain\Database\Traits\Validation;

        public $rules = [
            'mode' => 'required',
        ];

        public $attributeNames;
        public $implement      = ['System.Behaviors.SettingsModel'];
        public $settingsCode   = 'martin_adminer_settings';
        public $settingsFields = 'fields.yaml';

        public function __construct() {
            $this->attributeNames = [
                'mode' => Lang::get('martin.ssologin::lang.settings.mode'),
            ];
            parent::__construct();
        }

        public function filterFields($fields, $context = null) {
            $driver = config('database.default');
            if($driver == "sqlite") {
                $conn = OctoberAdminerHelper::getDBConnectionParams();
                $fields->sqlite_path->hidden = false;
                $fields->sqlite_path->value  = $conn['database'];
            }
        }

    }

?>