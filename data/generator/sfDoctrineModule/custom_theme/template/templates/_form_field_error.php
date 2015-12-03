[?php $_error = $form[$name]->getError() ?]

[?php if ($_error instanceof sfValidatorErrorSchema) { ?]
    [?php foreach ($_error as $error): ?]
        <p>[?php echo $error ?]</p>
    [?php endforeach; ?]
[?php } else if ($_error instanceof sfValidatorError) { ?]
    <p>[?php echo $_error ?]</p>
[?php } ?]