-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `number`, `neighborhood`) VALUES
(1, 'Rua Coronel', 845, 'Jardim'),
(2, 'Hélio Garroni', 25, 'Centro');

--
-- Extraindo dados da tabela `addresses_has_candidates`
--

INSERT INTO `addresses_has_candidates` (`addresses_id`, `candidates_id`) VALUES
(1, 1),
(2, 2);

--
-- Extraindo dados da tabela `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `birth_date`, `tel1`, `tel2`, `inscription_date`, `situation`, `units_id`, `parents_id`) VALUES
(1, 'João', '2002-05-04', 8864484548, 89456485856, '2019-06-25', -1, NULL, 1),
(2, 'Maria', '2015-12-06', 8741561565, 54156485185, '2019-06-25', 0, NULL, 2);

--
-- Extraindo dados da tabela `parents`
--

INSERT INTO `parents` (`id`, `mother`, `father`) VALUES
(1, 'Gisele', 'Arnaldo'),
(2, 'Liza', 'Bruno');

--
-- Extraindo dados da tabela `units`
--

INSERT INTO `units` (`id`, `name`, `users_id`) VALUES
(1, 'SEMED', 1),
(2, 'CEIM Vovó Donana', 2),
(3, 'CEIM Vovó Iracema', 3),
(4, 'CEIM Jardim das Oliveiras', 4);

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`) VALUES
(1, 'Admin', 'admin@gmail.com', '123', 1),
(2, 'Núbia', 'nubia@gmail.com', '123', 0),
(3, 'Deila', 'deila@gmail.com', '123', 0),
(4, 'Sandra', 'sandra@gmail.com', '123', 0);