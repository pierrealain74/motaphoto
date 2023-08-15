// figureTemplate.js
function createFigureHTML(item) {
    return `
    <div class="rolloverImg">
            <span class="rolloverImg-category">${item.category[0].name}</span>
            <span class="rolloverImg-reference">${item.tags[0].name}</span>
            <button class="rolloverImg-fullscreen"></button>
            <a href="infos-photo/?id=${item.id_post}&cat=${item.category[0].name}&index=0" class="rolloverImg-eye"></a>
        </div>
        <img src="${item.thumbnail}" class="img-gallery" alt="${item.post_title}" id="${item.id_post}" data-index="0">`;
}
