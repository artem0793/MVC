<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <div class="ui top attached tabular menu">
            <div class="active item" data-tab="sms"><i class="mobile large icon"></i> СМС</div>
            <div class="item" data-tab="email"><i class="mail outline large icon"></i> E-Mail</div>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="sms">
            <h4 class="ui header">СМС - рассылка</h4>
            <?php if (!count($sms_from)): ?>
                <p class="ui message warning">Модуль смс рассылки не настроен!</p>
            <?php endif; ?>
            <form method="post" class="ui form">
                <table class="ui celled structured dashboard table">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Деятельность</th>
                        <th class="column price">Цена</th>
                        <th>
                        <span class="popup" data-title="Отметить все">
                            <div class="ui fitted checkbox">
                                <input type="checkbox" class="select-all">
                            </div>
                        </span>
                        </th>
                        <th>Текст смс</th>
                        <th class="column phone">Телефоны</th>
                        <th>Включить в список отправки</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr data-uid="<?php print $item->uid; ?>">
                            <?php if (!is_null($item->rowspan)): ?>
                            <td class="top aligned"<?php if ($item->rowspan > 1): ?> rowspan="<?php print $item->rowspan; ?>"<?php endif; ?>>
                                <b><?php print $item->user_name; ?></b>
                            </td>
                            <?php endif; ?>
                            <td>
                                <?php print $item->activity_name; ?>
                            </td>
                            <td>
                                <div class="ui right labeled input price">
                                    <input type="number" step="0.01" placeholder="0.00" value="0.00" class="price">
                                    <div class="ui basic label">грн</div>
                                </div>
                            </td>
                            <td class="collapsing">
                                <div class="ui fitted checkbox">
                                    <input type="checkbox" value="<?php print $item->activity_short_name; ?>" class="activity">
                                </div>
                            </td>
                            <?php if (!is_null($item->rowspan)): ?>
                            <td class="top aligned collapsing"<?php if ($item->rowspan > 1): ?> rowspan="<?php print $item->rowspan; ?>"<?php endif; ?>>
                                <div class="field">
                                <textarea rows="<?php print $item->rowspan + 1;?>" cols="15" class="output"></textarea>
                                    <p>Осталось <span class="count">38</span> символов.</p>
                                </div>
                            </td>
                            <td<?php if ($item->rowspan > 1): ?> rowspan="<?php print $item->rowspan; ?>"<?php endif; ?>>
                                <div class="grouped fields">
                                    <?php foreach (explode(',', $item->phones) as $i => $phone): ?>
                                    <div class="field">
                                        <div class="ui checkbox">
                                            <input type="checkbox"<?php print !$i ? ' checked ' : ' '; ?>value="<?php print $phone; ?>" class="phone">
                                            <label><?php print $phone; ?></label>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                            <td class="collapsing"<?php if ($item->rowspan > 1): ?> rowspan="<?php print $item->rowspan; ?>"<?php endif; ?>>
                                <?php if (count($sms_from)): ?>
                                    <div class="grouped fields">
                                    <?php foreach ($sms_from as $name): ?>
                                    <div class="field">
                                        <div class="ui toggle checkbox">
                                            <input type="checkbox" value="<?php print $name; ?>" class="attached">
                                            <label>
                                                <?php print strlen($name) > 5 ? substr($name, 0, 4) . '...' : $name; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <button class="ui labeled primary icon button action-send" type="button">
                    <i class="mail forward icon"></i> Отправить <small>(Выбрано <span class="count">0</span> смс)</small>
                </button>
            </form>
        </div>
        <div class="ui bottom attached tab segment" data-tab="email">
            <h4 class="ui header">E-Mail - рассылка</h4>
            in progress
        </div>
    </div>
</div>
