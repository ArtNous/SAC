USE [CAVENIDA]
GO
/****** Object:  Table [dbo].[Clientes]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Marca](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](20) NOT NULL,
 CONSTRAINT [PK_Marca] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_Marca] UNIQUE NONCLUSTERED 
(
	[nombre] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Modelo]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Modelo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](20) NOT NULL,
	[marca] [int] NOT NULL,
 CONSTRAINT [PK_Modelo] PRIMARY KEY CLUSTERED 
(
	[id] ASC,
	[nombre] ASC,
	[marca] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[OrdenServicio]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[OrdenServicio](
	[nro_orden] [int] IDENTITY(1,1) NOT NULL,
	[cod_cliente] [nchar](15) NOT NULL,
	[placa] [nchar](10) NOT NULL,
	[fecha] [date] NOT NULL,
	[cod_vendedor] [varchar](5) NOT NULL,
	[fecha_inicio] [datetime] NULL,
	[fecha_final] [datetime] NULL,
	[servicio] [varchar](5) NOT NULL,
	[estatus] [int] NOT NULL,
	[tecnico] [varchar](15) NULL,
	[posicion_inicial] [int] NULL,
	[posicion_final] [int] NULL,
 CONSTRAINT [PK_OrdenServicio] PRIMARY KEY CLUSTERED 
(
	[nro_orden] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

ALTER TABLE [dbo].[OrdenServicio]  WITH CHECK ADD  CONSTRAINT [FK_Orden_Cliente] FOREIGN KEY([cod_cliente])
REFERENCES [dbo].[Clientes] ([CodigoCliente])

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Servicios]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Tecnicos]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Tecnicos](
	[cedula] [varchar](15) NOT NULL,
	[nombre] [varchar](50) NOT NULL,
	[estatus] [char](10) NULL,
	[codigoINT] [char](14) NOT NULL,
 CONSTRAINT [PK_Tecnicos] PRIMARY KEY CLUSTERED 
(
	[cedula] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TecnicoServicio]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TecnicoServicio](
	[servicio] [varchar](6) NOT NULL,
	[cedula_tecnico] [varchar](10) NOT NULL,
 CONSTRAINT [PK_TecnicoServicio] PRIMARY KEY CLUSTERED 
(
	[servicio] ASC,
	[cedula_tecnico] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TiempoAtencion]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TiempoAtencion](
	[servicio] [varchar](50) NOT NULL,
	[tipo_vehiculo] [int] NOT NULL,
	[tiempo] [int] NOT NULL,
 CONSTRAINT [PK_TiempoAtencion] PRIMARY KEY CLUSTERED 
(
	[servicio] ASC,
	[tipo_vehiculo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[TipoVehiculo]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[TipoVehiculo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](15) NOT NULL,
 CONSTRAINT [PK_TipoVehiculo] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [IX_TipoVehiculo] UNIQUE NONCLUSTERED 
(
	[descripcion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[usuarios]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[usuarios_orden](
	[cedula] [varchar](15) NOT NULL,
	[usuario] [varchar](20) NOT NULL,
	[password] [varchar](70) NOT NULL,
	[email] [varchar](50) NOT NULL
	[rol] [int](1) NOT NULL
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[Vehiculo]    Script Date: 16/09/2017 8:24:43 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Vehiculo](
	[placa] [varchar](10) NOT NULL,
	[modelo] [int] NOT NULL,
	[marca] [int] NOT NULL,
	[tipo_vehiculo] [int] NOT NULL,
	[cliente] [char](22) NULL,
	[km_actual] [float] NULL,
 CONSTRAINT [PK_Vehiculo] PRIMARY KEY CLUSTERED 
(
	[placa] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Vehiculo]  WITH CHECK ADD  CONSTRAINT [FK_Cliente_Vehiculo] FOREIGN KEY([placa])
REFERENCES [dbo].[Vehiculo] ([placa])
GO
ALTER TABLE [dbo].[Vehiculo] CHECK CONSTRAINT [FK_Cliente_Vehiculo]
GO
