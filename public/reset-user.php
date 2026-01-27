<?php
declare(strict_types=1);

/**
 * Temporary Laravel user reset tool.
 *
 * Usage:
 *   /reset-user.php?key=YOUR_SECRET
 *
 * Delete this file immediately after use.
 */

$laravelRoot = realpath(__DIR__ . '/..');
$secretKey = 'temp-reset-2026-01-27';

$keyFromRequest = (string)($_GET['key'] ?? $_POST['key'] ?? '');
if ($secretKey === '' || !hash_equals($secretKey, $keyFromRequest)) {
    http_response_code(403);
    exit('Forbidden. Missing or invalid key.');
}

require $laravelRoot . '/vendor/autoload.php';
$app = require $laravelRoot . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$message = null;
$error = null;
$matches = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idOrEmail = trim((string)($_POST['id_or_email'] ?? ''));
    $newName = trim((string)($_POST['new_name'] ?? ''));
    $newPassword = (string)($_POST['new_password'] ?? '');

    if ($idOrEmail === '') {
        $error = 'Enter a user ID or email.';
    } else {
        if (ctype_digit($idOrEmail)) {
            $user = \App\Models\User::find((int)$idOrEmail);
        } else {
            $user = \App\Models\User::where('email', $idOrEmail)->first();
        }

        if (!$user) {
            // If this looks like an email and a password was provided, create the user.
            if (!ctype_digit($idOrEmail) && filter_var($idOrEmail, FILTER_VALIDATE_EMAIL) && $newPassword !== '') {
                $nameToUse = $newName !== '' ? $newName : (string)strtok($idOrEmail, '@');

                $user = \App\Models\User::query()->create([
                    'name' => $nameToUse,
                    'email' => $idOrEmail,
                    'password' => \Illuminate\Support\Facades\Hash::make($newPassword),
                ]);

                $message = sprintf('Created user ID %d (%s).', $user->id, $user->email);
            } else {
                $error = 'User not found. Enter a valid email and a new password to create the first user.';

                if (!ctype_digit($idOrEmail) && $idOrEmail !== '') {
                    $like = '%' . str_replace(['%', '_'], '', $idOrEmail) . '%';
                    $matches = \App\Models\User::query()
                        ->select(['id', 'email', 'name'])
                        ->where('email', 'like', $like)
                        ->orWhere('name', 'like', $like)
                        ->orderBy('id')
                        ->limit(10)
                        ->get()
                        ->all();
                }
            }
        } else {
            if ($newName !== '') {
                $user->name = $newName;
            }
            if ($newPassword !== '') {
                $user->password = \Illuminate\Support\Facades\Hash::make($newPassword);
            }

            $user->save();
            $message = sprintf('Updated user ID %d (%s).', $user->id, $user->email);
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Temporary User Reset</title>
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; max-width: 720px; margin: 40px auto; padding: 0 16px; }
    label { display: block; margin-top: 12px; font-weight: 600; }
    input { width: 100%; padding: 8px; margin-top: 6px; box-sizing: border-box; }
    button { margin-top: 16px; padding: 10px 14px; font-weight: 600; cursor: pointer; }
    .msg { margin-top: 16px; padding: 10px; background: #f3f4f6; border: 1px solid #e5e7eb; }
    .err { margin-top: 16px; padding: 10px; background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
    .warn { margin-top: 12px; color: #b91c1c; font-weight: 700; }
    code { background: #f3f4f6; padding: 2px 6px; border-radius: 4px; }
  </style>
</head>
<body>
  <h1>Temporary User Reset</h1>
  <p class="warn">Delete <code>public/reset-user.php</code> immediately after use.</p>

  <?php if ($message): ?>
    <div class="msg"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="err"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
  <?php endif; ?>

  <?php if (!empty($matches)): ?>
    <div class="msg">
      <strong>Possible matches:</strong>
      <ul>
        <?php foreach ($matches as $m): ?>
          <li>
            <?php
              $label = sprintf(
                  '#%d | %s | %s',
                  (int)$m->id,
                  (string)($m->email ?? '(no email)'),
                  (string)($m->name ?? '(no name)')
              );
              echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8');
            ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <p>Copy the exact email or ID into the form above.</p>
    </div>
  <?php endif; ?>

  <form method="post" autocomplete="off">
    <input type="hidden" name="key" value="<?php echo htmlspecialchars((string)($_GET['key'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" />
    <label for="id_or_email">User ID or Email</label>
    <input id="id_or_email" name="id_or_email" placeholder="e.g. 1 or admin@example.com (email + password will create user)" required />

    <label for="new_name">New Name (optional)</label>
    <input id="new_name" name="new_name" placeholder="e.g. Admin User" />

    <label for="new_password">New Password (optional)</label>
    <input id="new_password" name="new_password" type="password" placeholder="Leave blank to keep current password" />

    <button type="submit">Update User</button>
  </form>
</body>
</html>




