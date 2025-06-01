INSERT INTO users (
    id,
    name,
    email,
    email_verified_at,
    password,
    role,
    remember_token,
    created_at,
    updated_at
  )
VALUES (
    'id:bigint',
    'name:varchar',
    'email:varchar',
    'email_verified_at:timestamp',
    'password:varchar',
    'role:enum',
    'remember_token:varchar',
    'created_at:timestamp',
    'updated_at:timestamp'
  );