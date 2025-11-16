<?php

namespace Infrastructure\Framework\Http;

use Application\UseCase\CreateUser;
use Application\UseCase\ListUsers;
use Application\UseCase\UpdateUser;
use Application\UseCase\DeleteUser;

class UserController
{
    private CreateUser $createUser;
    private ListUsers $listUsers;
    private UpdateUser $updateUser;
    private DeleteUser $deleteUser;

    public function __construct(CreateUser $createUser, ListUsers $listUsers, UpdateUser $updateUser, DeleteUser $deleteUser)
    {
        $this->createUser = $createUser;
        $this->listUsers = $listUsers;
        $this->updateUser = $updateUser;
        $this->deleteUser = $deleteUser;
    }

    public function form(): void
    {
        // Mostrar formulario de registro (no protegido)
        include __DIR__ . '/../View/user_form.php';
    }

    public function store(array $request): void
    {
        $name = $request['name'] ?? '';
        $email = $request['email'] ?? '';
        $password = $request['password'] ?? '';
        $user = $this->createUser->execute($name, $email, $password);
        include __DIR__ . '/../View/user_created.php';
    }

    public function index(): void
    {
        // Proteger ruta: requiere sesión
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user_id'])) {
            header('Location: /?login=form');
            exit;
        }

        $users = $this->listUsers->execute();
        include __DIR__ . '/../View/user_list.php';
    }

    public function edit(array $request): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user_id'])) {
            header('Location: /?login=form');
            exit;
        }

        $id = (int)($request['id'] ?? 0);
        // Find user by scanning the list (ListUsers returns all users)
        $user = null;
        $users = $this->listUsers->execute();
        foreach ($users as $u) {
            if ($u->getId() === $id) {
                $user = $u;
                break;
            }
        }

        if (!$user) {
            header('Location: /?list=listar');
            exit;
        }

        include __DIR__ . '/../View/user_edit_form.php';
    }

    public function update(array $request): void
    {
        $id = (int)($request['id'] ?? 0);
        $name = $request['name'] ?? '';
        $email = $request['email'] ?? '';
        $password = $request['password'] ?? null;

        $updated = $this->updateUser->execute($id, $name, $email, $password);
        // after update, redirect to list
        header('Location: /?list=listar');
        exit;
    }

    public function delete(array $request): void
    {
        $id = (int)($request['id'] ?? 0);
        if ($id > 0) {
            $this->deleteUser->execute($id);
        }
        header('Location: /?list=listar');
        exit;
    }
}
