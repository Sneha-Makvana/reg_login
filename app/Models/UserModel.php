<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'lname', 'email', 'password', 'gender', 'mobile_number', 'city',
         'profile_image', 'multiple_images'];
}
?>