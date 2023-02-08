<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Rating Controller
 *
 * @property \App\Model\Table\RatingTable $Rating
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatingController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $result = $this->Authentication->getIdentity();

        if($result->role == 0){
        $this->paginate = [
            'contain' => ['Users', 'Cars'],
        ];
    }else{
        return $this->redirect(['action' => 'template']); 
    }
        $rating = $this->paginate($this->Rating);

        $this->set(compact('rating'));
    }

    /**
     * View method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $result = $this->Authentication->getIdentity();

        if($result->role == 0){
        $rating = $this->Rating->get($id, [
            'contain' => ['Users', 'Cars'],
        ]);
    }
    else{
        return $this->redirect(['action' => 'template']);
    }
        $this->set(compact('rating'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $result = $this->Authentication->getIdentity();

        if($result->role == 0){
        $rating = $this->Rating->newEmptyEntity();
        if ($this->request->is('post')) {
            $rating = $this->Rating->patchEntity($rating, $this->request->getData());
            if ($this->Rating->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $users = $this->Rating->Users->find('list', ['limit' => 200])->all();
        $cars = $this->Rating->Cars->find('list', ['limit' => 200])->all();
        $this->set(compact('rating', 'users', 'cars'));
    }else{
        return $this->redirect(['action' => 'template']);
    }
    }

    /**
     * Edit method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
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
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $users = $this->Rating->Users->find('list', ['limit' => 200])->all();
        $cars = $this->Rating->Cars->find('list', ['limit' => 200])->all();
        $this->set(compact('rating', 'users', 'cars'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rating = $this->Rating->get($id);
        if ($this->Rating->delete($rating)) {
            $this->Flash->success(__('The rating has been deleted.'));
        } else {
            $this->Flash->error(__('The rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
}
