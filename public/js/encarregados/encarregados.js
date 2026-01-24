// JavaScript específico para Encarregados

console.log("[v0] Módulo de Encarregados carregado")

// Dados simulados de alunos
const alunosData = {
  1: {
    id: 1,
    nome: "João Silva",
    numero: "001234",
    turma: "10ºA",
    anoLetivo: "2025/2026",
    mediaGeral: 16.5,
    frequencia: 95,
    estado: "Ativo"
  },
  2: {
    id: 2,
    nome: "Maria Silva",
    numero: "001235",
    turma: "8ºB",
    anoLetivo: "2025/2026",
    mediaGeral: 17.0,
    frequencia: 98,
    estado: "Ativo"
  },
  3: {
    id: 3,
    nome: "Pedro Silva",
    numero: "001236",
    turma: "6ºC",
    anoLetivo: "2025/2026",
    mediaGeral: 15.8,
    frequencia: 92,
    estado: "Ativo"
  }
};

document.addEventListener("DOMContentLoaded", () => {
  console.log("[v0] Inicializando funcionalidades de Encarregados")

  // Inicializar pesquisa em tabelas
  const setupTableSearch = (tableId, options) => {
    console.log(`[v0] Pesquisa em tabela ${tableId} inicializada`)
  }
  setupTableSearch("searchTable", undefined)

  // Inicializar event listeners
  initializeEncarregadoListeners()
})

function initializeEncarregadoListeners() {
  console.log("[v0] Event listeners de Encarregado inicializados")

  // Listeners para visualizar detalhes
  const viewButtons = document.querySelectorAll(".btn-info")
  viewButtons.forEach((button) => {
    button.addEventListener("click", () => {
      console.log("[v0] Visualizar clicado")
    })
  })

  // Listeners para seletor de filhos
  const selectorFilhos = document.getElementById('seletor-filhos')
  if (selectorFilhos) {
    selectorFilhos.addEventListener('change', function() {
      const alunoId = this.value
      carregarDadosAluno(alunoId)
    })
  }

  // Listeners para seletor de alunos (detalhes)
  const selectorAlunos = document.getElementById('seletor-alunos')
  if (selectorAlunos) {
    selectorAlunos.addEventListener('change', function() {
      const alunoId = this.value
      carregarDetalhesAluno(alunoId)
    })
  }
}

/**
 * Carrega dados do aluno no dashboard
 * @param {number} alunoId - ID do aluno
 */
function carregarDadosAluno(alunoId) {
  console.log("[encarregados] Carregando dados do aluno:", alunoId)
  
  const aluno = alunosData[alunoId]
  if (!aluno) {
    console.error("Aluno não encontrado:", alunoId)
    return
  }

  // Aqui seria atualizado o dashboard com os dados do novo aluno
  // Exemplo: 
  // document.querySelector('[data-media-geral]').textContent = aluno.mediaGeral
  // document.querySelector('[data-frequencia]').textContent = aluno.frequencia + '%'
  // etc...

  console.log("[encarregados] Dados carregados com sucesso para:", aluno.nome)
}

/**
 * Carrega detalhes completos do aluno
 * @param {number} alunoId - ID do aluno
 */
function carregarDetalhesAluno(alunoId) {
  console.log("[encarregados] Carregando detalhes do aluno:", alunoId)
  
  const aluno = alunosData[alunoId]
  if (!aluno) {
    console.error("Aluno não encontrado:", alunoId)
    return
  }

  // Atualizar informações na página de detalhes
  const elementos = {
    nome: document.querySelector('h3.fw-bold'),
    numero: document.querySelector('[data-numero]'),
    turma: document.querySelector('[data-turma]'),
    anoLetivo: document.querySelector('[data-ano]'),
    mediaGeral: document.querySelector('[data-media]'),
    frequencia: document.querySelector('[data-freq]')
  }

  if (elementos.nome) elementos.nome.textContent = aluno.nome
  console.log("[encarregados] Detalhes do aluno carregados")
}

// Função para filtrar notas por período
function filterByPeriod(period) {
  console.log("[v0] Filtrando notas por período:", period)
}

// Função para gerar relatório de frequência
function generateFrequencyReport() {
  console.log("[v0] Gerando relatório de frequência")
  alert("Relatório de frequência gerado com sucesso!")
}

/**
 * Marcar reunião como confirmada
 * @param {HTMLElement} btn - Elemento do botão
 */
function marcarReuniaoConfirmado(btn) {
  btn.innerHTML = '<i class="fas fa-check me-1"></i>Presença Confirmada'
  btn.disabled = true
  btn.classList.remove('btn-primary')
  btn.classList.add('btn-success')
  
  console.log("[encarregados] Presença em reunião confirmada")
  mostrarNotificacao('Presença confirmada com sucesso!', 'success')
}

/**
 * Adicionar evento ao calendário
 */
function adicionarCalendario() {
  console.log("[encarregados] Adicionando evento ao calendário")
  mostrarNotificacao('Evento adicionado ao calendário!', 'info')
}

/**
 * Ler comunicado completo (abre modal)
 * @param {HTMLElement} btn - Elemento do botão
 */
function lerComunicado(btn) {
  console.log("[encarregados] Abrindo comunicado completo")
  const modal = new bootstrap.Modal(document.getElementById('comunicadoModal'))
  modal.show()
}

/**
 * Mostrar notificação ao utilizador
 * @param {string} mensagem - Mensagem a exibir
 * @param {string} tipo - Tipo de notificação (success, error, info, warning)
 */
function mostrarNotificacao(mensagem, tipo = 'info') {
  // Criar elemento de notificação
  const alertClass = {
    success: 'alert-success',
    error: 'alert-danger',
    info: 'alert-info',
    warning: 'alert-warning'
  }

  const alert = document.createElement('div')
  alert.className = `alert ${alertClass[tipo]} alert-dismissible fade show`
  alert.setAttribute('role', 'alert')
  alert.innerHTML = `
    ${mensagem}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  `

  // Adicionar ao DOM (fixo no topo)
  const container = document.querySelector('main') || document.body
  container.insertBefore(alert, container.firstChild)

  // Auto-remover após 5 segundos
  setTimeout(() => {
    alert.remove()
  }, 5000)
}

/**
 * Obter lista de filhos do encarregado
 * @returns {Array} Lista de alunos
 */
function obterListaFilhos() {
  return Object.values(alunosData)
}

/**
 * Filtrar avisos por tipo
 * @param {string} tipo - Tipo de aviso (reuniao, comunicado, feriado)
 */
function filtrarAvisos(tipo) {
  console.log("[encarregados] Filtrando avisos por tipo:", tipo)
  
  const avisos = document.querySelectorAll('.aviso-card')
  
  if (tipo === 'todos') {
    avisos.forEach(a => a.style.display = 'block')
  } else {
    avisos.forEach(a => {
      if (a.classList.contains(tipo)) {
        a.style.display = 'block'
      } else {
        a.style.display = 'none'
      }
    })
  }
}

console.log("[encarregados] Todas as funções carregadas com sucesso")
