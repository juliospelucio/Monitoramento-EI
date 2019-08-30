--
--
-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `number`, `neighborhood`) VALUES
(21, 'Caetano Pelúcio', 85, 'Cavaco'),
(22, 'Jose Francisco', 15, 'Centro'),
(31, 'Armando José', 516, 'Residencial dos Nobres'),
(32, 'Bartolomeu Camargo', 48, 'Vila Centenário'),
(33, 'Avenida Oeste', 20, 'Morada da Serra'),
(34, 'Pavão', 952, 'Jardim Chamonix'),
(35, 'José Leite', 85, 'Nova Machado'),
(36, 'Rua Bélgica', 48, 'Jardim Novo Milênio'),
(37, 'Rua Madre Sebastiana', 89, 'Vila do Céu'),
(38, 'Antonieta Andrade Pedroso', 5, 'Bom Jesus'),
(39, 'Rua Renato Andrade', 98, 'Jardim das Oliveiras II');

--
--
-- Extraindo dados da tabela `parents`
--

INSERT INTO `parents` (`id`, `mother`, `father`) VALUES
(21, 'Maria', 'Tomaz'),
(22, 'Kamila', 'Eric'),
(31, 'Sara', 'Ryan'),
(32, 'Daniela', 'Geovane'),
(33, 'Fernanda', 'Marcos'),
(34, 'Graziela', 'Eduardo'),
(35, 'Taina', 'Ronaldo'),
(36, 'Rosa', 'Erivelton'),
(37, 'Rita', 'Arnaldo'),
(38, 'Jaqueline', 'Elder'),
(39, 'Nayara', 'Michel');

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`) VALUES
(1, 'Admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70 ', '1'),
(2, 'Núbia', 'nubia@gmail.com', '202cb962ac59075b964b07152d234b70 ', '0'),
(3, 'Sandra', 'sandra@gmail.com', 'ec5dc02a6474cc095620e984af243d19', '0'),
(4, 'Deila', 'deila@gmail.com', 'ec5dc02a6474cc095620e984af243d19', '0');

--
-- Extraindo dados da tabela `units`
--

INSERT INTO `units` (`id`, `name`, `users_id`) VALUES
(1, 'SEMED', 1),
(2, 'CEIM Vovó Donana', 2),
(3, 'CEIM Jardim das Oliveiras', 3),
(4, 'CEIM Vovó Iracema', 4);

--
-- Extraindo dados da tabela `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `birth_date`, `tel1`, `tel2`, `inscription_date`, `situation`, `obs`, `conf_date`, `units_id`, `parents_id`) VALUES
(6, 'Marcos Pereira', '1997-01-31', 3574512445, 3574574524, '2019-08-14', 1, ' ', '2019-08-29', 2, 21),
(7, 'Bryam Maicom', '2017-05-07', 4523564558, 84512852225, '2019-08-23', 0, ' Irmão no CEMEAI', NULL, NULL, 22),
(13, 'Kayron Martins', '2017-08-22', 3584956554, 0, '2019-08-28', 1, '    Prefere Iracema', '2019-08-29', 2, 31),
(14, 'Anna Eduarda', '2015-12-06', 3588161379, 0, '2019-08-29', 0, 'Irmão na Vovó Donana', NULL, NULL, 32),
(15, 'Livia Andrade', '2015-02-21', 35987139546, 35988076671, '2019-08-29', -1, 'Pai trabalha no Alvorada', NULL, NULL, 33),
(16, 'Miguel Henrique ', '2017-02-14', 3588225467, 0, '2019-08-29', 1, ' ', '2019-08-29', 4, 34),
(17, 'Gabriely da Silva', '2014-06-15', 35997084491, 35997073040, '2019-08-29', 1, 'Irmão no Jardim', '2019-08-29', 3, 35),
(18, 'Kethelyn Gonçalves', '2013-09-09', 35988722806, 0, '2019-08-29', 0, 'Reside na casa da Avó(Matilde).', NULL, 2, 36),
(19, 'Yuri dos Santos', '2018-03-29', 35845245546, 3589454854, '2019-08-30', -1, '', NULL, NULL, 37),
(20, 'Gabriel Lucas', '2016-08-08', 3548564852, 3548956565, '2019-08-30', 1, '', '2019-08-30', 4, 38),
(21, 'Laura Leite     ', '2015-05-10', 3523655698, 3523588984, '2019-08-30', 1, '', '2019-08-30', 4, 39);

--
--
-- Extraindo dados da tabela `addresses_has_candidates`
--

INSERT INTO `addresses_has_candidates` (`addresses_id`, `candidates_id`) VALUES
(21, 6),
(22, 7),
(31, 13),
(32, 14),
(33, 15),
(34, 16),
(35, 17),
(36, 18),
(37, 19),
(38, 20),
(39, 21);