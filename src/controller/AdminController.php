<?php

require_once("model/UserBuilder.php");

class AdminController
{
    private $view, $storage, $router, $manager;
    protected $currentUserBuilder, $modifiedUserBuilder;

    public function __construct($view, $storage, $router, $manager)
    {
        $this->view = $view;
        $this->storage = $storage;
        $this->router = $router;
        $this->manager = $manager;
        $this->currentUserBuilder = key_exists('currentUserBuilder', $_SESSION) ? $_SESSION['currentUserBuilder'] : null;
        $this->modifiedUserBuilder = key_exists('modifiedUserBuilder', $_SESSION) ? $_SESSION['modifiedUserBuilder'] : array();
    }

    public function __destruct()
    {
        $_SESSION['currentUserBuilder'] = $this->currentUserBuilder;
        $_SESSION['modifiedUserBuilder'] = $this->modifiedUserBuilder;
    }

    public function showList()
    {
        $this->view->makeListPage($this->storage->readAll());
    }

    public function showInformation($id)
    {
        $user = $this->storage->readById($id);
        if ($user !== null) {
            $this->view->makeUserPage($user, $id);
        } else {
            $this->view->displayUnknownUser();
        }
    }

    public function newUser()
    {
        if ($this->currentUserBuilder === null) {
            $this->currentUserBuilder = new UserBuilder(null);
        }
        $this->view->makeUserCreationPage($this->currentUserBuilder);
    }

    public function saveNewUser($data)
    {
        $this->currentUserBuilder = new UserBuilder($data, false, false);
        if ($this->currentUserBuilder->isValid($this->manager)) {
            $user = $this->currentUserBuilder->createUser($this->manager);
            $id = $this->storage->create($user);
            $this->currentUserBuilder = null;
            $this->view->displayCreationUserSuccess($id);
        } else {
            $this->view->displayCreationUserFailure();
        }
    }

    public function askUpdateUser($id)
    {
        if (key_exists($id, $this->modifiedUserBuilder)) {
            $this->view->makeUserUpdatePage($this->modifiedUserBuilder[$id], $id);
        } else {
            $user = $this->storage->readById($id);
            if ($user !== null) {
                $this->view->makeUserUpdatePage(UserBuilder::buildFromUser($user, true, true), $id);
            } else {
                $this->view->displayUnknownUser();
            }
        }
    }

    public function updateUser($data)
    {
        if (isset($data['user_id'])) {
            $id = $data['user_id'];
            $user = $this->storage->readById($id);
            if ($user !== null) {
                $builder = new UserBuilder($data, true, true);
                if ($builder->isValid($this->manager)) {
                    $builder->updateUser($user);
                    if (!$this->storage->update($id, $user)) {
                        throw new Exception("Une erreur est survenue lors de la mise à jour de l'utilisateur");
                    }
                    unset($this->modifiedUserBuilder[$id]);
                    $this->view->displayUpdateUserSuccess($id);
                } else {
                    $this->modifiedUserBuilder[$id] = $builder;
                    $this->view->displayUpdateUserFailure($id);
                }
            } else {
                $this->view->displayUnknownUser();
            }
        } else {
            $this->view->displayUnknownUser();
        }
    }

    public function askDeletionUser($id)
    {
        $user = $this->storage->readById($id);
        if ($user !== null) {
            $this->view->makeUserDeletionPage($user, $id);
        } else {
            $this->view->displayUnknownUser();
        }
    }

    public function deleteUser($data)
    {
        if (isset($data['user_id'])) {
            $id = $data['user_id'];
            $user = $this->storage->readById($id);
            if ($user !== null) {
                if ($this->storage->delete($id)) {
                    $this->view->displayDeletionUserSuccess();
                } else {
                    $this->view->displayDeletionUserFailure($id);
                }
            } else {
                $this->view->displayUnknownUser();
            }
        } else {
            $this->view->displayUnknownUser();
        }
    }
}
