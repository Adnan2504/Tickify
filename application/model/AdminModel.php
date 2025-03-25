<?php

/**
 * Handles all data manipulation of the admin part
 */
class AdminModel
{
    /**
     * Simply write the deletion and suspension info for the user into the database, also puts feedback into session
     *
     * @param $userId
     * @param $suspensionTime
     * @param $delete
     * @return bool
     */
    private static function writeDeleteAndSuspensionInfoToDatabase($userId, $suspensionTime, $delete)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("UPDATE users SET user_suspension_timestamp = :user_suspension_timestamp, user_deleted = :user_deleted  WHERE user_id = :user_id LIMIT 1");
        $query->execute(array(
                ':user_suspension_timestamp' => $suspensionTime,
                ':user_deleted' => $delete,
                ':user_id' => $userId
        ));

        if ($query->rowCount() == 1) {
            Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_SUSPENSION_DELETION_STATUS'));
            return true;
        }
    }

    /**
     * Kicks the selected user out of the system instantly by resetting the user's session.
     * This means, the user will be "logged out".
     *
     * @param $userId
     * @return bool
     */
    private static function resetUserSession($userId)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("UPDATE users SET session_id = :session_id  WHERE user_id = :user_id LIMIT 1");
        $query->execute(array(
                ':session_id' => null,
                ':user_id' => $userId
        ));

        if ($query->rowCount() == 1) {
            Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_USER_SUCCESSFULLY_KICKED'));
            return true;
        }
    }
    /**
     * Update User Account Group/Type
     * @param $typeId
     * @param $userId
     * @param $newUsername
     * @param $newEmailAddress
     *
     * @return bool
     */
    public static function setAccountType($typeId = null, $userId = null, $newUsername = null, $newEmailAddress = null) {
        if (!$typeId || !$userId) {
            return false;
        }

        if ($userId == Session::get('user_id')) {
            Session::add('feedback_negative', 'Cannot edit your own account');
            return false;
        }

        UserRoleModel::saveRoleToDatabase($typeId, $userId);
        UserModel::saveNewUserName($userId, $newUsername);
        UserModel::saveNewEmailAddress($userId, $newEmailAddress);

        return false;
    }
}
