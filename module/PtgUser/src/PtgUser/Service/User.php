<?php
namespace PtgUser\Service;

use Zend\Authentication\AuthenticationService,
    Zend\Form\Form,
    Zend\Crypt\Password\Bcrypt,
    PtgBase\Service\ServiceAbstract,
    PtgUser\Entity\User as UserEntity;


class User extends ServiceAbstract
{
    /**
     * @var \PtgUser\Repository\User
     */
    protected $userRepos;

    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var Form
     */
    protected $loginForm;

    /**
     * @var Form
     */
    protected $editForm;

    /**
     * @var Form
     */
    protected $addForm;

    /**
     * @var Form
     */
    protected $changePasswordForm;
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    /**
     * @param int $id
     * @return UserEntity
     */
    public function get($id)
    {
        return $this->getUserRepository()->find($id);
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAll()
    {
        return $this->getUserRepository()->findAll();
    }
    
    public function getOneByUserName($username)
    {
        return $this->getUserRepository()->findOneBy(array("username" => $username));
    }
    
    public function getUsersSelectArray()
    {
        $users = $this->getUserRepository()->findAll();
        
        foreach($users as $user)
        {
            $array[$user->getId()] = $user->getDisplayName();
        }
        
        return $array;
    }

    /**
     * createFromForm
     *
     * @param array $data
     * @return \PtgUser\Entity\User
     * @throws Exception\InvalidArgumentException
     */
    public function add(array $post)
    {
        $form   = $this->getAddForm();
        $em     = $this->getEntityManager();
        $bcrypt = $this->getNewEncryptorInstance();
        
        $form->setData($post);
        
        if(!$form->isValid())throw new \PtgUser\Exception\Service\User\FormException("Form values are invalid");

        $data   = $form->getInputFilter()->getValues();
        $User   = new UserEntity();
        
        $User->setUsername($data["username"])
            ->setEmail($data["email"])
            ->setDisplayName($data["display_name"])
            ->setState(1)
            ->setPassword($bcrypt->create($User->getPassword()));
        
        $em->persist($User);        
        $em->flush();
        
        return $User;
    }

    /**
     * createFromForm
     *
     * @param array $data
     * @return \PtgUser\Entity\User
     * @throws Exception\InvalidArgumentException
     */
    public function edit(array $post)
    {
        $form   = $this->getEditForm();
        $em     = $this->getEntityManager();
        
        $form->setData($post);
        
        if(!$form->isValid())throw new \PtgUser\Exception\Service\User\FormException("Form values are invalid:");

        $data   = $form->getInputFilter()->getValues();
        $User   = $this->get($data["id"]);
        
        $User->setUsername($data["username"])
            ->setEmail($data["email"])
            ->setDisplayName($data["display_name"])
            ->setWebsite($data["website"])
            ->setImageUrl($data["image_url"])
            ->setBio($data["bio"])
            ->setState(1);
        
        $em->persist($User);        
        $em->flush();
        
        return $User;
    }
    
    public function remove($id)
    {
        $User   = $this->get($id);
        
        if(!$User)throw new \Exception("No user with that id.");
        
        $em     = $this->getEntityManager();
        
        $em->remove($User);
        $em->flush();
        
        return $this;
    }

    /**
     * change the current users password
     *
     * @param array $data
     * @return UserEntity
     */
    public function changePassword(array $data)
    {
        $User = $this->get($data["id"]);
        
        if(!$User)throw new \Exception("User invalid in change password");
        
        $form = $this->getChangePasswordForm($User->getId());
                
        $form->setData($data);
        
        if(!$form->isValid())throw new \PtgUser\Exception\Service\User\FormException("Form values are invalid:");

        $clean_data   = $form->getInputFilter()->getValues();
        
        $newPass = $clean_data['password'];

        $bcrypt = new Bcrypt;
        
        $bcrypt->setCost($this->getPasswordCost());

        $pass = $bcrypt->create($newPass);
        
        $User->setPassword($pass);
        
        $this->getEntityManager()->persist($User);
        $this->getEntityManager()->flush();

        return $User;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getUserRepository()
    {
        if (null === $this->userRepos)
        {
            $this->userRepos = $this->getServiceManager()->get('ptguser_user_repos');
        }
        
        return $this->userRepos;
    }

    /**
     * @param \Doctrine\ORM\EntityRepository $userRepos
     * @return User
     */
    public function setUserRepository(\Doctrine\ORM\EntityRepository $userRepos)
    {
        $this->userRepos = $userRepos;
        
        return $this;
    }

    /**
     * getAuthService
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        if (null === $this->authService)
        {
            $this->authService = $this->getServiceManager()->get('wdguser_auth_service');
        }
        return $this->authService;
    }

    /**
     * setAuthenticationService
     *
     * @param AuthenticationService $authService
     * @return User
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        
        return $this;
    }

    /**
     * @return Form
     */
    public function getEditForm($id = null)
    {
        if (null === $this->editForm)
        {
            $this->editForm = $this->getServiceManager()->get('FormElementManager')->get('wdguser_edit_form');
        }
        
        $form = $this->editForm;
        
        if($id && $user = $this->get($id))
        {
            $form->populateValues($user->toArray());
        }
        
        return $this->editForm;
    }

    /**
     * @return Form
     */
    public function getAddForm()
    {
        if (null === $this->addForm)
        {
            $this->addForm = $this->getServiceManager()->get('FormElementManager')->get('wdguser_add_form');
        }
        
        return $this->addForm;
    }
    
    /**
     * @return Form
     */
    public function getLoginForm()
    {
        if (null === $this->loginForm)
        {
            $this->loginForm = $this->getServiceManager()->get('FormElementManager')->get('wdguser_login_form');
        }
        
        return $this->loginForm;
    }

    /**
     * @param Form $editForm
     * @return User
     */
    public function setEditForm(Form $editForm)
    {
        $this->editForm = $editForm;
        
        return $this;
    }

    /**
     * @return Form
     */
    public function getChangePasswordForm($id)
    {
        if (null === $this->changePasswordForm) 
        {
            $this->changePasswordForm = $this->getServiceManager()->get('FormElementManager')->get('wdguser_change_password_form');
        }
        
        $form = $this->changePasswordForm;
        
        if($id)
        {
            $form->get("id")->setValue($id);
        }
        
        return $this->changePasswordForm;
    }

    /**
     * @param Form $changePasswordForm
     * @return User
     */
    public function setChangePasswordForm(Form $changePasswordForm)
    {
        $this->changePasswordForm = $changePasswordForm;
        
        return $this;
    }
    
    /**
     * set service options
     *
     * @param UserServiceOptionsInterface $options
     */
    public function setOptions(UserServiceOptionsInterface $options)
    {
        $this->options = $options;
    }
    
    /**
     * @return \Zend\Crypt\Password\Bcrypt
     */
    protected function getNewEncryptorInstance()
    {
        $bcrypt = new \Zend\Crypt\Password\Bcrypt();
        
        $bcrypt->setCost($this->getPasswordCost());
        
        return $bcrypt;
    }
    
    protected function getPasswordCost()
    {
        return 14;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        if($this->entityManager === null)
        {
            $this->entityManager = $this->getServiceManager()->get("doctrine.entity_manager.orm_default");
        }
        
        return $this->entityManager;
    }
}
