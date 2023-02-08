<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */


    public $paginate = ['limit'=> 5];
    public function beforeFilter(\Cake\Event\EventInterface $event)
{

    $this->loadModel('Cars');
    $this->loadModel('Brands');
    $this->loadModel('Rating');

    $this->loadComponent('Flash');
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login','add']);
}
/************************Login user *******************************/
 
 public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();   
    if ($result && $result->isValid()) {
        // redirect to /articles after login success
        $user = $this->Authentication->getIdentity();  
        if($user['status'] == '0'){
            $this->Flash->error(__('You have no permission for login!'));
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'logout',
            ]);
        }else{
            if($user->role == 0){
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'carlist',
                ]);
            } else{
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'template',
                ]);
            }
        }       
        return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }
}



/************************User Logout *******************************/

public function logout()
{
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}
/************************User login profile*******************************/


public function userprofile($id=null)
{
    $result= $this->Authentication->getIdentity();
    $user = $this->Authentication->getResult();
    if ($user && $user->isValid()) {
        $user = $this->Authentication->getIdentity();
        $id =$user->id;
        // print_r($id);
        // die;
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $users = $this->request->getData();
        $users['id']=$id;
        // pr($user);
        // die;
        $this->set(compact('user','result'));
    }
}
public function userprofiledit($id=null)
{
    $result = $this->Authentication->getIdentity();

    
    $user = $this->Users->get($id, [
        'contain' => [],
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The userprofile  has been saved.'));

            return $this->redirect(['action' => 'userprofile',$id]);
        }
        $this->Flash->error(__('The user could not be saved user profile. Please, try again.'));
    }
    $this->set(compact('user','result'));
}

/************************User Template *******************************/

    public function template()
    {

        $this->paginate = [
            'contain' => ['Users', 'Brands'],
        ];
        // $key= $this->request->getQuery('key');
        
        // if($key){
        //  $query = $this->Cars->find('all')->where(['or'=>['Cars.name like'=>'%'.$key.'%','make like'=>'%'.$key.'%','model like'=>'%'.$key.'%','color like'=>'%'.$key.'%']]);
        // }else{
        //     $query = $this->Cars;
        // }
        $cars = $this->paginate($this->Cars);
    
        $this->set(compact('cars'));
    }
/************************Check User Status *******************************/

public function userstatus($id=null,$status)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->get($id); 
        if($status == '1')
            $user->status = '0';
         else
            $user->status = '1';
        if($this->Users->save($user))
        {
            $this->Flash->success(__('The status  has been changed.'));  
        }
        return $this->redirect(['action' => 'index']);
        
    }
/************************Check car Status *******************************/

public function carstatus($id=null,$status)
    {
        $this->request->allowMethod(['post']);
        $car = $this->Cars->get($id); 
        if($status == '1')
            $car->status = '0';
         else
            $car->status = '1';
        if($this->Cars->save($car))
        {
            $this->Flash->success(__('The status  has been changed.'));  
        }
        return $this->redirect(['action' => 'carlist']);
        
    }

/************************Brands Add*******************************/

    public function addbrand()
    {
        $result = $this->Authentication->getIdentity();

        if($result->role == 0){
            $brand = $this->Brands->newEmptyEntity();
            if ($this->request->is('post')) {
                $brand = $this->Brands->patchEntity($brand, $this->request->getData());
                if ($this->Brands->save($brand)) {
                    $this->Flash->success(__('The brand has been saved.'));
    
                    return $this->redirect(['action' => 'carlist']);
                }
                $this->Flash->error(__('The brand could not be saved. Please, try again.'));
            }
            $users = $this->Brands->Users->find('list', ['limit' => 200])->all();
            $this->set(compact('brand', 'users','result'));

        }else{
            return $this->redirect(['action' => 'template']);
        }
        
    }
/************************Brand List*******************************/
    
    public function brandlist()
    {
        $result = $this->Authentication->getIdentity();
      

        if($result->role == 0){
        $this->paginate = [
            'contain' => ['Users'],
            'order' =>['id' => 'DESC']
        ];}else{
          return $this->redirect(['action' => 'template']);  
        }
        $brands = $this->paginate($this->Brands);

        $this->set(compact('brands','result'));
    }

/************************Brand Edit *******************************/

    public function brandedit($id = null)
    {
        $this->paginate = ['limit'=> 5];
        $brand = $this->Brands->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $brand = $this->Brands->patchEntity($brand, $this->request->getData());
            if ($this->Brands->save($brand)) {
                $this->Flash->success(__('The brand edit has been saved.'));

                return $this->redirect(['action' => 'brandlist']);
            }
            $this->Flash->error(__('The brand edit could not be saved. Please, try again.'));
        }
        $users = $this->Brands->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('brand', 'users'));
    }

/************************Brand Delete *******************************/

    public function branddelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $brand = $this->Brands->get($id);
        if ($this->Brands->delete($brand)) {
            $this->Flash->success(__('The brand has been deleted.'));
        } else {
            $this->Flash->error(__('The brand could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
/************************User List*******************************/

    public function index()
    {
        $result = $this->Authentication->getIdentity();
        $users = $this->paginate($this->Users->find('all')->where(['role' => 1])->order(['id' => 'desc']));
        $status=$this->request->getQuery('status');
        if($status == null){
            $users=$this->Users->find('all');
        }else{
            $users=$this->Users->find('all')->where(['status'=>$status]);
        }
        $this->set(compact('users','result'));
        if($this->request->is('ajax')){
        
            // start code will work in case of json return from here
            echo json_encode($users);
            die;
            
            $this->autoRender = false;
           
           $this->layout = false;
           $this->render('/element/tabledata');
           
           // end code will work in case of json return from here

            // start code will work in case of element rander from here
           
         // end code will work in case of element rander from here
        }       
    
            // $users = $this->paginate($this->Users);

        
       
    }

    // public function dindex()
    // {
    //  $result = $this->Authentication->getIdentity();
   
    //     $status=$this->request->getQuery('status');
    //     $users = $this->paginate($this->Users->find('all')->where(['role' => 1])->order(['id' => 'desc']));
    //     if($status == null){
    //         $users=$this->Users->find('all');
    //     }else{
    //         $users=$this->Users->find('all')->where(['status'=>$status]);
    //     }
        
    //     if($this->request->is('ajax')){
    //         $this->set(compact('users','result'));
    //         // start code will work in case of json return from here
    //     //     echo json_encode($users);
    //     //    die;
    //        // end code will work in case of json return from here

    //         // start code will work in case of element rander from here
    //        $this->autoRender = false;
           
    //        $this->layout = false;
    //        $this->render('/element/tabledata');
    //      // end code will work in case of element rander from here
    //     }       
    
    //         // $users = $this->paginate($this->Users);

    //         // $this->set(compact('users','result'));
       
    // } 
/************************view User*******************************/

    public function view($id = null)
    {
        $result = $this->Authentication->getIdentity();

        $user = $this->Users->get($id, [
            'contain' => ['Brands', 'Cars', 'Rating'],
        ]);

        $this->set(compact('user','result'));
   
   
    }

/************************Add User*******************************/

    public function add()
    { $result = $this->Authentication->getResult();

        if (!$result->isValid()) {
            $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user','result'));}
        else{
            return $this->redirect(['action' => 'template']);

        }
     
    }

/************************Edit User*******************************/


    public function edit($id = null)
    {
        $result = $this->Authentication->getIdentity();

        if($result->role == 0){
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
    }else{
        return $this->redirect(['action' => 'template']);
    }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user edit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user','result'));
    }

/************************Delete User*******************************/
   
    public function delete($id = null)
    {
        $result = $this->Authentication->getIdentity();

        if($result->role == 0){
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }else{
        return $this->redirect(['action' => 'template']);
    }
    }
/************************Add Cars*******************************/

    public function addcars()
    {
        $result = $this->Authentication->getIdentity();
        if($result->role == 0){
        $car = $this->Cars->newEmptyEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
             
            $image = $this->request->getData('image_file');

            $name = $image->getClientFilename();

            $targetPath = WWW_ROOT.'img'.DS.$name;

            if($name)  
                $image->moveTo($targetPath);
                $car->image = $name;

            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car add has been saved.'));

                return $this->redirect(['action' => 'carlist']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200])->all();
        $brands = $this->Cars->Brands->find('list', ['limit' => 200])->all();
        $this->set(compact('car', 'users', 'brands','result'));
    }else{
        return $this->redirect(['action' => 'template']);
    }
    }

/************************Car listing*******************************/

public function carlist()
{
    $this->paginate = ['limit'=> 5];
   
    $result = $this->Authentication->getIdentity();
    if($result->role == 0){
        $this->paginate = [
            'contain' => ['Users', 'Brands'],
            'order' =>['id' => 'DESC']
        ];
    }else{
        return $this->redirect(['action' => 'template']); 
    }
    // $key= $this->request->getQuery('key');
    
    // if($key){
    //     $query = $this->Cars->find('all')->where(['Cars.status like'=>'%'.$key.'%']);
        
    // }else{
    //     $query = $this->Cars;           
        
    // }
    
        $cars = $this->paginate($this->Cars);
        $this->set(compact('cars','result'));
}

/************************Car edit*******************************/

public function caredit($id = null)
    {
        $result= $this->Authentication->getIdentity();

    if($result->role == 0){
        $car = $this->Cars->get($id, [
            'contain' => [],
        ]);
    }else{
        return $this->redirect(['action' => 'template']); 
    }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            $image = $this->request->getData('image_file');

            $name = $image->getClientFilename();

            $targetPath = WWW_ROOT.'img'.DS.$name;

            if($name)  
                $image->moveTo($targetPath);
                $car->image = $name;
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The car edit has been saved.'));

                return $this->redirect(['action' => 'carlist']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200])->all();
        $brands = $this->Cars->Brands->find('list', ['limit' => 200])->all();
        $this->set(compact('car', 'users', 'brands','result'));
    }
/************************ Car view *******************************/

public function carview($id = null)
{
    $result= $this->Authentication->getIdentity();
    $car = $this->Cars->get($id, [
        'contain' => ['Users', 'Brands', 'Rating'],
       
    ]);

    $this->set(compact('car','result'));
}

/************************ Car delete *******************************/

public function cardelete($id = null)
{
    $result= $this->Authentication->getIdentity();

    if($result->role == 0){
    $this->request->allowMethod(['post', 'delete']);
    $car = $this->Cars->get($id);
    if ($this->Cars->delete($car)) {
        $this->Flash->success(__('The car has been deleted.'));
    } else {
        $this->Flash->error(__('The car could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'carlist']);
}else{
    return $this->redirect(['action' => 'carlist']); 
}
}


/************************ Users car view *******************************/

public function usercarview($id = null)
{
    $result= $this->Authentication->getIdentity();
    $car = $this->Cars->get($id, [
        'contain' => ['Users', 'Brands', 'Rating'],
    ]);
    $this->set(compact('car','result'));
    $rating = $this->Rating->newEmptyEntity();
   
        if ($this->request->is(['patch','post', 'put'])) {
            $rating = $this->Rating->patchEntity($rating, $this->request->getData());
           $rating->user_id = $result['id'];
           
            if ($this->Rating->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'usercarview',$id]);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $users = $this->Rating->Users->find('list', ['limit' => 200])->all();
        $cars = $this->Rating->Cars->find('list', ['limit' => 200])->all();
        $this->set(compact('rating', 'users', 'cars'));
}
/************************ Rating list *******************************/

public function ratinglist()
{
    $result= $this->Authentication->getIdentity();

    if($result->role == 0){
    $this->paginate = [
        'contain' => ['Users', 'Cars'],
        'order' =>['id' => 'DESC']
    ];
}else{
    return $this->redirect(['action' => 'template']); 
}
    $rating = $this->paginate($this->Rating);

    $this->set(compact('rating','result'));
}
/************************Rating view*******************************/

public function ratingview($id = null)
{
    $result= $this->Authentication->getIdentity();

    $rating = $this->Rating->get($id, [
        'contain' => ['Users', 'Cars'],
    ]);

    $this->set(compact('rating','result'));
}

/************************Rating delete *******************************/

public function ratingdelete($id = null)
{
    $this->request->allowMethod(['post', 'delete']);
    $rating = $this->Rating->get($id);
    if ($this->Rating->delete($rating)) {
        $this->Flash->success(__('The rating has been deleted.'));
    } else {
        $this->Flash->error(__('The rating could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'ratinglist',$id]);
}

/************************Rating Edit *******************************/


public function ratingedit($id = null)
    {
        $result = $this->Authentication->getIdentity();

        if($result->role == 0){
        $rating = $this->Rating->get($id, [
            'contain' => [],
        ]);
    }else{
        return $this->redirect(['action' => 'template']);
    }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rating = $this->Rating->patchEntity($rating, $this->request->getData());
            if ($this->Rating->save($rating)) {
                $this->Flash->success(__('The rating  edit has been saved.'));

                return $this->redirect(['action' => 'ratinglist',$id]);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $users = $this->Rating->Users->find('list', ['limit' => 200])->all();
        $cars = $this->Rating->Cars->find('list', ['limit' => 200])->all();
        $this->set(compact('rating', 'users', 'cars','result'));
    }


    

}
