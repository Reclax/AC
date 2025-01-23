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

public class LoginFrame extends JFrame {
    private JTextField txtCedula;
    private JPasswordField txtClave;
    private JButton btnLogin;
    private JButton btnRegister;

    public LoginFrame() {
        // Configuración básica de la ventana
        setTitle("Login");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(350, 250);
        setLocationRelativeTo(null);

        // Usar GridBagLayout para organizar los componentes
        setLayout(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(10, 10, 10, 10); // Márgenes entre componentes

        // Inicializar componentes
        txtCedula = new JTextField(15);
        txtClave = new JPasswordField(15);
        btnLogin = new JButton("Iniciar Sesión");
        btnRegister = new JButton("Registrar");

        // Etiqueta Cédula
        gbc.gridx = 0;
        gbc.gridy = 0;
        gbc.anchor = GridBagConstraints.LINE_END;
        add(new JLabel("Cédula:"), gbc);

        // Campo Cédula
        gbc.gridx = 1;
        gbc.anchor = GridBagConstraints.LINE_START;
        add(txtCedula, gbc);

        // Etiqueta Clave
        gbc.gridx = 0;
        gbc.gridy = 1;
        gbc.anchor = GridBagConstraints.LINE_END;
        add(new JLabel("Clave:"), gbc);

        // Campo Clave
        gbc.gridx = 1;
        gbc.anchor = GridBagConstraints.LINE_START;
        add(txtClave, gbc);

        // Botón Login
        gbc.gridx = 0;
        gbc.gridy = 2;
        gbc.gridwidth = 2;
        gbc.anchor = GridBagConstraints.CENTER;
        add(btnLogin, gbc);

        // Botón Registrar
        gbc.gridy = 3;
        add(btnRegister, gbc);

        // Acción del botón Login
        btnLogin.addActionListener(e -> {
            String cedula = txtCedula.getText();
            String clave = new String(txtClave.getPassword());

            UserDAO userDAO = new UserDAO();
            User user = userDAO.login(cedula, clave);

            if (user != null) {
                if (user.isEsAdmin()) {
                    new AdminReportFrame().setVisible(true);
                } else {
                    new SurveyFrame(user).setVisible(true);
                }
                dispose();
            } else {
                JOptionPane.showMessageDialog(this, "Credenciales inválidas");
            }
        });

        // Acción del botón Registrar
        btnRegister.addActionListener(e -> {
            String cedula = txtCedula.getText();
            String clave = new String(txtClave.getPassword());

            // Solicitar más detalles de usuario
            String nombre = JOptionPane.showInputDialog(this, "Ingrese su nombre:");
            String apellido = JOptionPane.showInputDialog(this, "Ingrese su apellido:");
            boolean admin = false; // Los usuarios registrados no son administradores por defecto

            User newUser = new User(cedula, nombre, apellido, clave, admin);
            UserDAO userDAO = new UserDAO();
            if (userDAO.registerUser(newUser)) {
                JOptionPane.showMessageDialog(this, "Usuario registrado exitosamente");
            } else {
                JOptionPane.showMessageDialog(this, "Error al registrar el usuario");
            }
        });
    }
}
