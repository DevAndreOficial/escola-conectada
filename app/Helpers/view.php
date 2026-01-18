<?php

function view(string $template, array $data = [])
{
    global $twig;

    return $twig->render(str_replace('.', '/', $template) . '.twig', $data);
}
