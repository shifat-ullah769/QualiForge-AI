<?php

test('public registration screen is unavailable', function () {
    $response = $this->get('/register');

    $response->assertNotFound();
});

test('public users cannot register an account', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertNotFound();

    $this->assertGuest();
});