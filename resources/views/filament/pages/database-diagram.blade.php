<x-filament::page>
    <script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/svg-pan-zoom/dist/svg-pan-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@interactjs/interactjs/dist/interact.min.js"></script>
    <script>
        let panZoomInstance;

        document.addEventListener("DOMContentLoaded", () => {
            // Inicializar o Mermaid
            mermaid.initialize({
                startOnLoad: true,
                theme: 'default',
                securityLevel: 'loose',
                flowchart: { useMaxWidth: false },
                er: { useMaxWidth: false },
            });

            // Adicionar funcionalidade de pan e zoom no SVG
            setTimeout(() => {
                const svgElement = document.querySelector('.mermaid > svg');
                if (svgElement) {
                    svgElement.setAttribute('preserveAspectRatio', 'xMidYMid meet');
                    svgElement.setAttribute('width', '100%');
                    svgElement.setAttribute('height', '100%');

                    panZoomInstance = svgPanZoom(svgElement, {
                        zoomEnabled: true,
                        controlIconsEnabled: false,
                        fit: true,
                        center: true,
                    });

                    // Habilitar o Drag and Drop nas tabelas
                    enableDragAndDrop(svgElement);
                }
            }, 500); // Timeout para esperar o Mermaid renderizar o SVG
        });

        // Função para habilitar drag and drop
        function enableDragAndDrop(svgElement) {
            interact(svgElement.querySelectorAll('g.class')).draggable({
                listeners: {
                    move(event) {
                        const target = event.target;

                        // Obter as coordenadas atuais
                        const dx = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                        const dy = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                        // Atualizar a posição
                        target.style.transform = `translate(${dx}px, ${dy}px)`;
                        target.setAttribute('data-x', dx);
                        target.setAttribute('data-y', dy);
                    }
                }
            });
        }

        // Funções para os botões de controle
        function zoomIn() {
            if (panZoomInstance) panZoomInstance.zoomIn();
        }

        function zoomOut() {
            if (panZoomInstance) panZoomInstance.zoomOut();
        }

        function resetZoom() {
            if (panZoomInstance) panZoomInstance.resetZoom();
        }
    </script>

    <!-- Container do diagrama -->
    <div style="position: relative; width: 100%; height: 70vh; border: 1px solid #ccc;">
        <!-- Botões de controle -->
        <div style="
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            padding: 10px;
            display: flex;
            gap: 5px;
        ">
            <button onclick="zoomIn()" style="padding: 5px 10px; background: white; border: none; border-radius: 5px; cursor: pointer;">+</button>
            <button onclick="zoomOut()" style="padding: 5px 10px; background: white; border: none; border-radius: 5px; cursor: pointer;">-</button>
            <button onclick="resetZoom()" style="padding: 5px 10px; background: white; border: none; border-radius: 5px; cursor: pointer;">Reset</button>
        </div>

        <!-- Diagrama Mermaid -->
        <div class="mermaid" style="width: 100%; height: 100%; overflow: hidden;">
            {!! $mermaidDiagram !!}
        </div>
    </div>
</x-filament::page>
