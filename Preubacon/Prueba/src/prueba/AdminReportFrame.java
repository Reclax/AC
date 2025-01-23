/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package prueba;
import javax.swing.*;
import java.awt.*;
import java.util.Map;

/**
 *
 * @author marco
 */
public class AdminReportFrame extends JFrame {
    private JLabel lblPregunta1Si;
    private JLabel lblPregunta1No;
    private JLabel lblPregunta2Si;
    private JLabel lblPregunta2No;
    private JButton btnCerrar;

    public AdminReportFrame() {
        // Configuración básica de la ventana
        setTitle("Reporte de Encuestas");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(400, 300);
        setLocationRelativeTo(null);

        // Establecer un diseño de cuadrícula para organizar los elementos
        setLayout(new GridLayout(6, 1, 10, 10)); // 6 filas, 1 columna, con espaciado

        // Inicializar etiquetas con valores predeterminados
        lblPregunta1Si = new JLabel("Pregunta 1 (Sí): 0", SwingConstants.CENTER);
        lblPregunta1No = new JLabel("Pregunta 1 (No): 0", SwingConstants.CENTER);
        lblPregunta2Si = new JLabel("Pregunta 2 (Sí): 0", SwingConstants.CENTER);
        lblPregunta2No = new JLabel("Pregunta 2 (No): 0", SwingConstants.CENTER);

        // Agregar las etiquetas a la ventana
        add(new JLabel("Resultados de la Encuesta", SwingConstants.CENTER)); // Título
        add(lblPregunta1Si);
        add(lblPregunta1No);
        add(lblPregunta2Si);
        add(lblPregunta2No);

        // Botón para cerrar sesión
        btnCerrar = new JButton("Cerrar Sesión");
        JPanel panelBotones = new JPanel();
        panelBotones.add(btnCerrar);
        add(panelBotones);

        // Acción del botón Cerrar Sesión
        btnCerrar.addActionListener(e -> {
            dispose(); // Cierra la ventana actual
            new LoginFrame().setVisible(true); // Regresa a la ventana de inicio de sesión
        });

        // Cargar los reportes de las encuestas
        loadReports();
    }

    // Método para cargar los reportes de la base de datos
    private void loadReports() {
        SurveyDAO surveyDAO = new SurveyDAO();

        // Obtener los resultados de las preguntas
        Map<String, Integer> reporte1 = surveyDAO.getReportePregunta1();
        Map<String, Integer> reporte2 = surveyDAO.getReportePregunta2();

        // Actualizar los textos de las etiquetas con los valores de la base de datos
        lblPregunta1Si.setText("Pregunta 1 (Sí): " + reporte1.getOrDefault("Si", 0));
        lblPregunta1No.setText("Pregunta 1 (No): " + reporte1.getOrDefault("No", 0));
        lblPregunta2Si.setText("Pregunta 2 (Sí): " + reporte2.getOrDefault("Si", 0));
        lblPregunta2No.setText("Pregunta 2 (No): " + reporte2.getOrDefault("No", 0));
    }
}
