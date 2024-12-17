<style>
    .tree-container {
        margin-left: 20px;
        border-left: 2px dashed #ccc;
        padding-left: 15px;
    }

    .tree-item {
        position: relative;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .tree-item:hover {
        background-color: #f8f9fa;
    }

    .my-tooltip {
        display: none;
        position: absolute;
        background-color: #000;
        color #fff !important;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        max-width: 150px;
        z-index: 100;
    }

</style>


<div class="container my-5">
    <h1 class="text-center mb-4">Дерево регионов и городов</h1>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong><?= $title ?? "" ?></strong>
        </div>
        <div class="card-body">
            <div>
                <?php foreach ($items ?? [] as $country): ?>
                <div class="tree-item">
                    <span class="tooltip-item" data-tooltip="<?= $country['description'] ?>">
                        <?= $country['name'] ?>
                    </span>
                </div>
                <div class="tree-container">
                    <?php foreach ($country['regions'] as $region): ?>
                        <div class="tree-item">
                            <span class="tooltip-item" data-tooltip="<?= $region['description'] ?>">
                                <?= $region['name'] ?>
                            </span>
                        </div>
                        <div class="tree-container">
                            <?php foreach ($region['cities'] as $regionCity): ?>
                                <div class="tree-item">
                                    <span class="tooltip-item" data-tooltip="<?= $regionCity['description'] ?>">
                                        <?= $regionCity['name'] ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    <?php foreach ($country['cities'] as $city): ?>
                        <div class="tree-item">
                            <span class="tooltip-item" data-tooltip="<?= $city['description'] ?>">
                                <?= $city['name'] ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        let tooltip = $('<div class="my-tooltip"></div>')
        $('body').append(tooltip);

        $('.tooltip-item').hover(function (event) {
            let tooltipText = $(this).data('tooltip');
            console.log(tooltipText);
            tooltip.text(tooltipText);

            let offset = $(this).offset();
            tooltip.css({
                top: offset.top - tooltip.outerHeight() - 5,
                left: offset.left + ($(this).outerWidth() / 2) - (tooltip.outerWidth() / 2),
                display: 'block',
                color: '#fff'
            });
        }, function () {
            tooltip.css('display', 'none');
        });
    });
</script>

