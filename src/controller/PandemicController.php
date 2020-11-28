<?php

require_once("model/Pandemic.php");
require_once("model/PandemicBuilder.php");
require_once("model/Storage.php");
require_once("view/PandemicView.php");

class PandemicController
{
    private $view, $storage, $router, $manager;
    protected $currentPandemicBuilder, $modifiedPandemicBuilder, $user;

    public function __construct($view, $storage, $router, $manager)
    {
        $this->view = $view;
        $this->storage = $storage;
        $this->router = $router;
        $this->manager = $manager;
        $this->user = $manager->getUser();
        $this->currentPandemicBuilder = key_exists('currentPandemicBuilder', $_SESSION) ? $_SESSION['currentPandemicBuilder'] : null;
        $this->modifiedPandemicBuilder = key_exists('modifiedPandemicBuilder', $_SESSION) ? $_SESSION['modifiedPandemicBuilder'] : array();
    }

    public function showInformation($id,$user) {
        $pandemic = $this->storage->read($id);
        if($pandemic !== null){
            $this->view->makePandemicPage($pandemic, $id, $user);
        } else {
            $this->view->displayUnknownPandemic();
        }
    }

    public function showList()
    {
        $this->view->makeListPage($this->storage->readAll());
    }

    public function saveNewPandemic($data)
    {
        $data['creator'] = $this->manager->getUser()->getUsername();
        $builder = new PandemicBuilder($data);
        if ($builder->isValid()) {
            $pandemic = $builder->createPandemic();
            $id = $this->storage->create($pandemic);
            $this->currentPandemicBuilder = null;
            $this->view->displayCreationPandemicSuccess($id);
        } else {
            $this->view->displayCreationPandemicFailure();
        }
    }

    public function askUpdatePandemic($id)
    {
        if (key_exists($id, $this->modifiedPandemicBuilder)) {
            $this->view->makePandemicUpdatePage($this->modifiedPandemicBuilder[$id], $id);
        } else {
            $pandemic = $this->storage->read($id);
            if ($pandemic !== null) {
                if ($this->permission($pandemic)) {
                    $this->view->makePandemicUpdatePage(PandemicBuilder::buildFromPandemic($pandemic), $id);
                } else {
                    $this->view->show403("Vous n'êtes pas le créateur de cette pandémie et vous n'êtes pas un administrateur.");
                }
            } else {
                $this->view->displayUnknownPandemic();
            }
        }
    }

    public function updatePandemic($data)
    {
        echo "a";
        if (isset($data['pandemic_id'])) {
            $id = $data['pandemic_id'];
            $pandemic = $this->storage->read($id);
            if ($pandemic !== null) {
                if ($this->permission($pandemic)) {
                    $builder = new PandemicBuilder($data);
                    if ($builder->isValid()) {
                        $builder->updatePandemic($pandemic);
                        if (!$this->storage->update($id, $pandemic)) {
                            throw new Exception("Une erreur est survenue lors de la mise à jour de la pandémie");
                        }
                        unset($this->modifiedPandemicBuilder[$id]);
                        $this->view->displayUpdatePandemicSuccess($id);
                    } else {
                        $this->modifiedPandemicBuilder[$id] = $builder;
                        $this->view->displayUpdatePandemicFailure($id);
                    }
                } else {
                    $this->view->show403("Vous n'êtes pas le créateur de cette pandémie et vous n'êtes pas un administrateur.");
                }
            } else {
                $this->view->displayUnknownPandemic();
            }
        } else {
            $this->view->displayUnknownPandemic();
        }
    }

    public function askDeletionPandemic($id)
    {
        $pandemic = $this->storage->read($id);
        if ($pandemic !== null) {
            if ($this->permission($pandemic)) {
                $this->view->makePandemicDeletionPage($pandemic, $id);
            } else {
                $this->view->show403("Vous n'êtes pas le créateur de cette pandémie et vous n'êtes pas un administrateur.");
            }
        } else {
            $this->view->displayUnknownPandemic();
        }
    }

    public function deletePandemic($data)
    {
        if (isset($data['pandemic_id'])) {
            $id = $data['pandemic_id'];
            $pandemic = $this->storage->read($id);
            if ($pandemic !== null) {
                if ($this->permission($pandemic)) {
                    if ($this->storage->delete($id)) {
                        $this->view->displayDeletionPandemicSuccess();
                    } else {
                        $this->view->displayDeletionPandemicFailure($id);
                    }
                } else {
                    $this->view->show403("Vous n'êtes pas le créateur de cette pandémie et vous n'êtes pas un administrateur.");
                }
            } else {
                $this->view->displayUnknownPandemic();
            }
        } else {
            $this->view->displayUnknownPandemic();
        }
    }

    private function permission($pandemic)
    {
        return $this->manager->getUser()->getUsername() === $pandemic->getCreator() || $this->manager->isAdminConnected();
    }
}
