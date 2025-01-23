/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package prueba;
import javax.swing.*;
import java.awt.*;

/**
 *
 * @author marco
 */

public class SurveyFrame extends JFrame {
    private User user;
    private JLabel lblNombre;
    private JRadioButton rbPregunta1Si;
    private JRadioButton rbPregunta1No;
    private JRadioButton rbPregunta2Si;
    private JRadioButton rbPregunta2No;
    private JButton btnEnviar;
    private JButton btnCancelar;

    public SurveyFrame(User user) {
        this.user = user;

        // Configuración básica de la ventana
        setTitle("Encuesta");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(500, 400);
        setLocationRelativeTo(null);

        // Usar GridBagLayout para organizar los componentes
        setLayout(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(10, 10, 10, 10); // Márgenes uniformes

        // Etiqueta con el nombre del usuario
        lblNombre = new JLabel("Usuario: " + user.getNombre() + " " + user.getApellido());
        lblNombre.setFont(new Font("Arial", Font.BOLD, 16));
        lblNombre.setHorizontalAlignment(SwingConstants.CENTER);

        gbc.gridx = 0;
        gbc.gridy = 0;
        gbc.gridwidth = 2;
        gbc.anchor = GridBagConstraints.CENTER;
        add(lblNombre, gbc);

        // Pregunta 1: Programación Orientada a Objetos
        gbc.gridwidth = 1;
        gbc.gridx = 0;
        gbc.gridy = 1;
        gbc.anchor = GridBagConstraints.LINE_END;
        add(new JLabel("¿Sabes Programación Orientada a Objetos?"), gbc);

        rbPregunta1Si = new JRadioButton("Sí");
        rbPregunta1No = new JRadioButton("No");
        ButtonGroup groupPregunta1 = new ButtonGroup();
        groupPregunta1.add(rbPregunta1Si);
        groupPregunta1.add(rbPregunta1No);

        JPanel panelPregunta1 = new JPanel();
        panelPregunta1.add(rbPregunta1Si);
        panelPregunta1.add(rbPregunta1No);

        gbc.gridx = 1;
        gbc.anchor = GridBagConstraints.LINE_START;
        add(panelPregunta1, gbc);

        // Pregunta 2: PHP
        gbc.gridx = 0;
        gbc.gridy = 2;
        gbc.anchor = GridBagConstraints.LINE_END;
        add(new JLabel("¿Sabes PHP?"), gbc);

        rbPregunta2Si = new JRadioButton("Sí");
        rbPregunta2No = new JRadioButton("No");
        ButtonGroup groupPregunta2 = new ButtonGroup();
        groupPregunta2.add(rbPregunta2Si);
        groupPregunta2.add(rbPregunta2No);

        JPanel panelPregunta2 = new JPanel();
        panelPregunta2.add(rbPregunta2Si);
        panelPregunta2.add(rbPregunta2No);

        gbc.gridx = 1;
        gbc.anchor = GridBagConstraints.LINE_START;
        add(panelPregunta2, gbc);

        // Botones
        btnEnviar = new JButton("Enviar");
        btnCancelar = new JButton("Cancelar");

        JPanel panelBotones = new JPanel();
        panelBotones.add(btnEnviar);
        panelBotones.add(btnCancelar);

        gbc.gridx = 0;
        gbc.gridy = 3;
        gbc.gridwidth = 2;
        gbc.anchor = GridBagConstraints.CENTER;
        add(panelBotones, gbc);

        // Lógica de la encuesta
        SurveyDAO surveyDAO = new SurveyDAO();
        if (surveyDAO.hasUserCompletedSurvey(user.getCedula())) {
            // Mostrar encuesta en modo solo lectura
            Survey survey = surveyDAO.getUserSurvey(user.getCedula());
            showReadOnlySurvey(survey);
        }

        // Acción del botón Enviar
        btnEnviar.addActionListener(e -> {
            if (!rbPregunta1Si.isSelected() && !rbPregunta1No.isSelected() ||
                !rbPregunta2Si.isSelected() && !rbPregunta2No.isSelected()) {
                JOptionPane.showMessageDialog(this, "Debe responder todas las preguntas");
                return;
            }

            Survey survey = new Survey();
            survey.setCedula(user.getCedula());
            survey.setPregunta1(rbPregunta1Si.isSelected());
            survey.setPregunta2(rbPregunta2Si.isSelected());

            if (surveyDAO.saveSurvey(survey)) {
                JOptionPane.showMessageDialog(this, "Encuesta guardada exitosamente");
                dispose();
                new LoginFrame().setVisible(true);
            } else {
                JOptionPane.showMessageDialog(this, "Error al guardar la encuesta");
            }
        });

        // Acción del botón Cancelar
        btnCancelar.addActionListener(e -> {
            dispose();
            new LoginFrame().setVisible(true);
        });
    }

    private void showReadOnlySurvey(Survey survey) {
        // Desactivar todos los componentes y mostrar las respuestas previas
        rbPregunta1Si.setEnabled(false);
        rbPregunta1No.setEnabled(false);
        rbPregunta2Si.setEnabled(false);
        rbPregunta2No.setEnabled(false);

        if (survey.isPregunta1()) rbPregunta1Si.setSelected(true);
        else rbPregunta1No.setSelected(true);

        if (survey.isPregunta2()) rbPregunta2Si.setSelected(true);
        else rbPregunta2No.setSelected(true);

        btnEnviar.setEnabled(false);
    }
}