<?php
    function command(string $command): void {
        $result = match ($command) {
            'ls', 'ps', 'whoami', 'id', 'pwd', 'uname -a' => execute($command),
            default => 'Ошибка, данная команда не поддерживается'
        };
        if ($result == null) throw new Exception();
        echo 'Команда: ', $command, '. Результат: ', $result;
    }

    function execute(string $command): string | null {
        exec($command, $output, $status);
        return implode(' ', $output);
    }
?>